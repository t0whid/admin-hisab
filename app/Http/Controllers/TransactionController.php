<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'last_transaction' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
            'transaction_date' => 'required|date',

        ]);

        $customer = Customer::findOrFail($customerId);

        $transaction = new Transaction();
        $transaction->customer_id = $customer->id;
        $transaction->type = $request->type;
        $transaction->last_transaction = $request->last_transaction;
        $transaction->description = $request->description;
        $transaction->updated_by = Auth::user()->name;
        $transaction->created_at = $request->transaction_date;

        if ($request->type == 'credit') {
            $customer->amount += $request->last_transaction;
        } else {
            $customer->amount -= $request->last_transaction;
        }
        $transaction->total_amount = $customer->amount;
        $transaction->save();
        $customer->save();

        return redirect()->route('customers.show', $customerId)->with('success', 'Transaction recorded successfully.');
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $customerId = $transaction->customer_id;
        $customer = Customer::findOrFail($customerId);

        return view('transactions.edit', compact('transaction', 'customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:credit,debit',
            'last_transaction' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
            'transaction_date' => 'required|date',

        ]);

        $transaction = Transaction::findOrFail($id);
        $customerId = $transaction->customer_id;
        $customer = Customer::findOrFail($customerId);

        /* dd($customer); */

        if ($transaction->type == 'credit') {
            $customer->amount -= $transaction->last_transaction;
        } else {
            $customer->amount += $transaction->last_transaction;
        }

        $transaction->type = $request->type;
        $transaction->last_transaction = $request->last_transaction;
        $transaction->description = $request->description;
        $transaction->updated_by = Auth::user()->name;
        $transaction->created_at = $request->transaction_date;


        if ($request->type == 'credit') {
            $customer->amount += $request->last_transaction;
        } else {
            $customer->amount -= $request->last_transaction;
        }

        $transaction->total_amount = $customer->amount;
        $transaction->save();
        $customer->save();

        return redirect()->route('customers.show', $transaction->customer_id)->with('success', 'Transaction updated successfully.');
    }
}
