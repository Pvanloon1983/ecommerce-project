<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');