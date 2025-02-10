<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\LoginController;
use Illuminate\Auth\Events\PasswordReset;
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
Route::get('/logout', function () { return redirect()->route('login'); });

// Email verify after register
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

// Password forgot
Route::get('/wachtwoord-vergeten', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/wachtwoord-vergeten', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::ResetLinkSent
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/wachtwoord-resetten/{token}', function (Request $request, string $token) {
    $email = $request->query('email'); // Get the email from the URL

    // Check if the token exists in the database
    $exists = DB::table('password_reset_tokens')
        ->where('email', $email)
        ->where('token', $token)
        ->exists();

    if (!$exists) {
        return Redirect::route('login')->withErrors(['reset_token_invalid' => 'Ongeldige of verlopen reset link.']);
    }

    return view('auth.reset-password', ['token' => $token, 'email' => $email]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PasswordReset
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');