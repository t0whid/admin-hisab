<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function create($customerId)
    {
        $customer = Customer::findOrFail($customerId);

        return view('transactions.create', compact('customer'));
    }

    public function store(Request $request, $customerId)
    {
        $request->validate([
            'type' => 'required|in:credit,debit',
            'last_transaction' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        $customer = Customer::findOrFail($customerId);

        DB::transaction(function () use ($request, $customer) {
            $amount = (float) $request->last_transaction;

            if ($request->type === 'credit') {
                $customer->amount = (float) $customer->amount + $amount;
            } else {
                $customer->amount = (float) $customer->amount - $amount;
            }

            $customer->save();

            $transaction = new Transaction();
            $transaction->customer_id = $customer->id;
            $transaction->type = $request->type;
            $transaction->last_transaction = $amount;
            $transaction->description = $request->description;
            $transaction->updated_by = Auth::user()->name ?? 'System';
            $transaction->total_amount = $customer->amount;

            /*
             * User selected date ke transaction date hisebe rakha hocche.
             * Time current time thakbe.
             */
            $transaction->created_at = $request->transaction_date . ' ' . now()->format('H:i:s');
            $transaction->updated_at = now();

            $transaction->save();
        });

        return redirect()
            ->route('customers.show', $customerId)
            ->with('success', 'Transaction recorded successfully.');
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $customer = Customer::findOrFail($transaction->customer_id);

        return view('transactions.edit', compact('transaction', 'customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:credit,debit',
            'last_transaction' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        $transaction = Transaction::findOrFail($id);
        $customer = Customer::findOrFail($transaction->customer_id);

        DB::transaction(function () use ($request, $transaction, $customer) {
            /*
             * Step 1: Old transaction effect reverse
             */
            if ($transaction->type === 'credit') {
                $customer->amount = (float) $customer->amount - (float) $transaction->last_transaction;
            } else {
                $customer->amount = (float) $customer->amount + (float) $transaction->last_transaction;
            }

            /*
             * Step 2: New transaction effect apply
             */
            $newAmount = (float) $request->last_transaction;

            if ($request->type === 'credit') {
                $customer->amount = (float) $customer->amount + $newAmount;
            } else {
                $customer->amount = (float) $customer->amount - $newAmount;
            }

            $customer->save();

            $transaction->type = $request->type;
            $transaction->last_transaction = $newAmount;
            $transaction->description = $request->description;
            $transaction->updated_by = Auth::user()->name ?? 'System';
            $transaction->total_amount = $customer->amount;
            $transaction->created_at = $request->transaction_date . ' ' . optional($transaction->created_at)->format('H:i:s');
            $transaction->updated_at = now();

            $transaction->save();
        });

        return redirect()
            ->route('customers.show', $transaction->customer_id)
            ->with('success', 'Transaction updated successfully.');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $customer = Customer::findOrFail($transaction->customer_id);

        DB::transaction(function () use ($transaction, $customer) {
            /*
             * Delete korar age transaction effect reverse korte hobe.
             */
            if ($transaction->type === 'credit') {
                $customer->amount = (float) $customer->amount - (float) $transaction->last_transaction;
            } else {
                $customer->amount = (float) $customer->amount + (float) $transaction->last_transaction;
            }

            $customer->save();

            $transaction->delete();

            /*
             * Optional but useful:
             * Delete/update er por remaining transactions er total_amount recalculate.
             * Eta history balance consistent rakhbe.
             */
            $this->recalculateCustomerTransactions($customer->id);
        });

        return redirect()
            ->route('customers.show', $customer->id)
            ->with('success', 'Transaction deleted successfully.');
    }

    private function recalculateCustomerTransactions($customerId): void
    {
        $customer = Customer::findOrFail($customerId);

        $transactions = Transaction::where('customer_id', $customerId)
            ->orderBy('created_at', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $runningTotal = 0;

        foreach ($transactions as $transaction) {
            if ($transaction->type === 'credit') {
                $runningTotal += (float) $transaction->last_transaction;
            } else {
                $runningTotal -= (float) $transaction->last_transaction;
            }

            $transaction->total_amount = $runningTotal;
            $transaction->saveQuietly();
        }

        $customer->amount = $runningTotal;
        $customer->saveQuietly();
    }
}