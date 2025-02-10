<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Auth\Events\PasswordReset;

class PasswordResetController
{
    public function passwordforgot()
    {
        return view('auth.forgot-password');
    }

    public function passwordforgotPost(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Send password reset link to the provided email
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function passwordreset(Request $request, string $token)
    {
        $email = $request->query('email'); // Get email from the URL query

        // Retrieve the user as a User model instance
        $user = User::where('email', $email)->first();
    
        if (!$user) {
            return Redirect::route('login')->withErrors(['reset_token_invalid' => 'Ongeldige of verlopen reset link.']);
        }
    
        // Now check if the token is valid using the Password::getRepository() method
        $repo = Password::getRepository();
        $isValid = $repo->exists($user, $token);
    
        if (!$isValid) {
            return Redirect::route('login')->withErrors(['reset_token_invalid' => 'Ongeldige of verlopen reset link.']);
        }
    
        // If the token is valid, show the reset password form
        return view('auth.reset-password', ['token' => $token, 'email' => $email]);
    }

    public function passwordresetPost(Request $request)
    {
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
    }
}
