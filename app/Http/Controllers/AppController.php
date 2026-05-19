<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $todayTransactions = Transaction::with('customer')
            ->whereDate('updated_at', $today)
            ->latest('updated_at')
            ->get();

        $totalDebit = $todayTransactions
            ->where('type', 'debit')
            ->sum('last_transaction');

        $totalCredit = $todayTransactions
            ->where('type', 'credit')
            ->sum('last_transaction');

        $total = $totalCredit - $totalDebit;

        $allTimeTotal = Customer::sum('amount');

        $revenueComparison = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            $dailyTransactions = Transaction::whereDate('updated_at', $date)->get();

            $dailyDebit = $dailyTransactions
                ->where('type', 'debit')
                ->sum('last_transaction');

            $dailyCredit = $dailyTransactions
                ->where('type', 'credit')
                ->sum('last_transaction');

            $dailyTotal = $dailyCredit - $dailyDebit;

            $revenueComparison[$date->format('Y-m-d')] = $dailyTotal;
        }

        return view('layout.dashboard', compact(
            'allTimeTotal',
            'todayTransactions',
            'total',
            'revenueComparison',
            'totalDebit',
            'totalCredit'
        ));
    }

    public function showReport(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Selected Date
        |--------------------------------------------------------------------------
        | GET request hole today date use korbe.
        | POST request hole form er selected date use korbe.
        */
        $selectedDate = $request->input('date', Carbon::today()->format('Y-m-d'));

        try {
            $selectedDate = Carbon::parse($selectedDate)->format('Y-m-d');
        } catch (\Exception $e) {
            $selectedDate = Carbon::today()->format('Y-m-d');
        }

        $allTimeTotal = Customer::sum('amount');

        $transactions = Transaction::with('customer')
            ->whereDate('updated_at', $selectedDate)
            ->latest('updated_at')
            ->get();

        $totalDebit = $transactions
            ->where('type', 'debit')
            ->sum('last_transaction');

        $totalCredit = $transactions
            ->where('type', 'credit')
            ->sum('last_transaction');

        $total = $totalCredit - $totalDebit;

        $revenueComparison = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::parse($selectedDate)->subDays($i);

            $dailyTransactions = Transaction::whereDate('updated_at', $date)->get();

            $dailyDebit = $dailyTransactions
                ->where('type', 'debit')
                ->sum('last_transaction');

            $dailyCredit = $dailyTransactions
                ->where('type', 'credit')
                ->sum('last_transaction');

            $dailyTotal = $dailyCredit - $dailyDebit;

            $revenueComparison[$date->format('Y-m-d')] = $dailyTotal;
        }

        return view('layout.report', compact(
            'transactions',
            'allTimeTotal',
            'selectedDate',
            'total',
            'revenueComparison',
            'totalDebit',
            'totalCredit'
        ));
    }
}