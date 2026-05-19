<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BackupController;


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'register'])->name('register');



Route::middleware('auth')->group(function () {
    Route::get('/', [AppController::class, 'index'])->name('index');
    // Route::get('/index', [AppController::class, 'index'])->name('index');
    Route::post('/report', [AppController::class, 'showReport'])->name('report');    Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('customers/store', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('customers/{id}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');

    Route::get('/customers/{customerId}/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/customers/{customerId}/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])->name('transactions.update');
    
    Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');

Route::get('/backup-download', [BackupController::class, 'downloadBackupZip'])->name('backup.downloadzip');

});




