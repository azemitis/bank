<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\TwoFactorRegistrationController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/accounts/create', [AccountController::class, 'create'])->name('accounts.create');
    Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
    Route::delete('/accounts/{account}', [AccountController::class, 'destroy'])->name('accounts.destroy');

    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    Route::get('/deposits/index', [DepositController::class, 'index'])->name('deposits.index');
    Route::get('/deposits/create', [DepositController::class, 'create'])->name('deposits.create');
    Route::post('/deposits', [DepositController::class, 'store'])->name('deposits.store');
    Route::delete('/deposits/{depositAccount}', [DepositController::class, 'withdraw'])
        ->name('deposits.withdraw');

    Route::get('/crypto/index', [CryptoController::class, 'index'])->name('crypto.index');
    Route::get('/crypto/create', [CryptoController::class, 'create'])->name('crypto.create');
    Route::post('/crypto', [CryptoController::class, 'store'])->name('crypto.store');
    Route::delete('/crypto/{cryptocurrency}', [CryptoController::class, 'destroy'])->name('crypto.destroy');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
});

require __DIR__.'/auth.php';

Route::get('/register', [TwoFactorRegistrationController::class, 'create'])->name('register');
Route::post('/register', [TwoFactorRegistrationController::class, 'store']);
