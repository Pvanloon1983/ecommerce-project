<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);

// Register user
Route::get('/registreren', [RegisterController::class, 'create'])->name('register')->middleware('guest');;
Route::post('/registreren', [RegisterController::class, 'store']);

// User Login
Route::get('/inloggen', [LoginController::class, 'create'])->name('login')->middleware('guest');
Route::post('/inloggen', [LoginController::class, 'store']);

// User logout
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');
Route::get('/logout', function () { return redirect()->route('login'); });

// Email verify after register
Route::get('/email/verify', [RegisterController::class, 'emailverify'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [RegisterController::class, 'emailverifyID'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [RegisterController::class, 'emailverifyNote'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Password forgot function
Route::get('/wachtwoord-vergeten', [PasswordResetController::class, 'passwordforgot'])->middleware('guest')->name('password.request');
Route::post('/wachtwoord-vergeten', [PasswordResetController::class, 'passwordforgotPost'])->middleware('guest')->name('password.email');
Route::get('/wachtwoord-resetten/{token}', [PasswordResetController::class, 'passwordreset'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'passwordresetPost'])->middleware('guest')->name('password.update');