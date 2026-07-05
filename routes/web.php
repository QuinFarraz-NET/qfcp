<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home');

Route::view('/dashboard', 'pages.dashboard')
    ->middleware(['auth'])
    ->name('dashboard');






require __DIR__.'/auth.php';

