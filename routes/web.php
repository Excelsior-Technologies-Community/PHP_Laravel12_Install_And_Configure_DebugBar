<?php

use Illuminate\Support\Facades\Route;
use Barryvdh\Debugbar\Facades\Debugbar; // ✅ CORRECT FACADE

Route::get('/', function () {

    // Send a message to Laravel Debugbar
    Debugbar::info('Debugbar is working successfully!');

    return view('welcome');
});
