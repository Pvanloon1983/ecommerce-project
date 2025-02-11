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

// Email verify after register
Route::get('/email/verify', [RegisterController::class, 'emailverify'])->name('verification.notice')->middleware('auth');
Route::get('/email/verify/{id}/{hash}', [RegisterController::class, 'emailverifyID'])->name('verification.verify')->middleware(['auth', 'signed']);
Route::post('/email/verification-notification', [RegisterController::class, 'emailverifyNote'])->name('verification.send')->middleware(['auth', 'throttle:6,1']);

// User Login
Route::get('/inloggen', [LoginController::class, 'create'])->name('login')->middleware('guest');
Route::post('/inloggen', [LoginController::class, 'store']);

// Password forgot function
Route::get('/wachtwoord-vergeten', [PasswordResetController::class, 'passwordforgot'])->name('password.request')->middleware('guest');
Route::post('/wachtwoord-vergeten', [PasswordResetController::class, 'passwordforgotPost'])->name('password.email')->middleware('guest');
Route::get('/wachtwoord-resetten/{token}', [PasswordResetController::class, 'passwordreset'])->name('password.reset')->middleware('guest');
Route::post('/reset-password', [PasswordResetController::class, 'passwordresetPost'])->name('password.update')->middleware('guest');

// User logout
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');
Route::get('/logout', function () { return redirect()->route('login'); });