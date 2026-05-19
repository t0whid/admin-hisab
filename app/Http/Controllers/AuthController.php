<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('index'));
        }

        return redirect()->route('login')
            ->withErrors(['login' => trans('auth.failed')])
            ->withInput($request->only('login', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    public function register()
    {
        $user = new User();
        $user->user_name = 'towhid';
        $user->name = 'Towhid Hasan';
        $user->email = 'towhid@gmail.com';
        $user->phone = '01521256487';
        /* $user->role = 2; */
        $user->password = Hash::make('1234');
        $user->status = 1;
        $user->image = 'assets/towhid.jpg';

        $user->save();

        return redirect()->route('login')->with('success', 'User registered successfully. Please log in.');
    }

    /* public function index()
    {
        $todayTransactions = Transaction::whereDate('created_at', Carbon::today())->with('customer')->get();
    
        $totalDebit = $todayTransactions->where('type', 'debit')->sum('last_transaction');
        $totalCredit = $todayTransactions->where('type', 'credit')->sum('last_transaction');
        $total = $totalCredit- $totalDebit;
    
        return view('layout.dashboard', compact('todayTransactions', 'totalDebit', 'totalCredit', 'total'));
    } */

    /*  public function index()
    {
        $todayTransactions = Transaction::whereDate('created_at', Carbon::today())->get();
        $totalDebit = $todayTransactions->where('type', 'debit')->sum('last_transaction');
        $totalCredit = $todayTransactions->where('type', 'credit')->sum('last_transaction');
        $total = $totalCredit - $totalDebit;

        $monthlyRevenue = Transaction::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(CASE WHEN type = "credit" THEN last_transaction ELSE -last_transaction END) as total_revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('layout.dashboard', compact('todayTransactions', 'total', 'monthlyRevenue', 'totalDebit', 'totalCredit'));
    } */


    
}
