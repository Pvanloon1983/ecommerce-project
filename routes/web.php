<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);

Route::get('/registreren', [RegisterController::class, 'create'])->name('register')->middleware('guest');;
Route::post('/registreren', [RegisterController::class, 'store']);

Route::get('/inloggen', [LoginController::class, 'create'])->name('login')->middleware('guest');
Route::post('/inloggen', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');
// GET route to redirect unauthorized users
Route::get('/logout', function () {
    return redirect()->route('login');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('resent', 'Verificatie link opnieuw verzonden');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');