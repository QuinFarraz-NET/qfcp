<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Internal\QFSenseController;


Route::view('/', 'pages.home');

Route::view('/dashboard', 'pages.dashboard')
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware(['auth'])
    ->prefix('internal')
    ->group(function () {

        Route::get('/qfsense', QFSenseController::class)
            ->name('internal.qfsense');

    });



require __DIR__.'/auth.php';

