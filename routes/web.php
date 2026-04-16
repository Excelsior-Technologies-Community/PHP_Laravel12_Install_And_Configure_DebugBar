<?php

use Illuminate\Support\Facades\Route;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;

// Home/dashboard
Route::get('/', [HomeController::class, 'index']);

// Download PDF (allow dots in filename)
Route::get('/download/{file}', [HomeController::class, 'downloadFile'])
    ->where('file', '.*');

// API endpoint
Route::get('/users', [ApiController::class, 'users']);