<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;

class RegisterController
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $validatedAttributes = request()->validate([
            'first_name'  => ['required'],
            'last_name'   => ['required'],
            'email'       => ['required', 'email', 'unique:users,email'],
            'password'    => ['required', Password::min(8), 'confirmed'], // password_confirmation
        ], [
            'first_name.required' => 'Voornaam is verplicht.',
            'last_name.required'  => 'Achternaam is verplicht.',
            'email.required'      => 'E-mailadres is verplicht.',
            'email.email'         => 'Geef een geldig e-mailadres op.',
            'password.required'   => 'Wachtwoord is verplicht.',
            'password.min'        => 'Wachtwoord moet minimaal 8 tekens lang zijn.',
            'password.confirmed'  => 'Wachtwoorden komen niet overeen.',
        ]);
    
        $validatedAttributes['password'] = Hash::make($validatedAttributes['password']);
    
        // create the user
        $user = User::create($validatedAttributes);

        // Log the user in
        Auth::login($user);
    
        // Fire the Registered event
        event(new Registered($user));
    
        // Ensure the user is redirected to the email verification route
        return redirect(route('verification.notice'));
    }
}
