<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApiController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/download/{file}', [HomeController::class, 'downloadFile'])
    ->where('file', '.*');

Route::get('/admin/dashboard', [HomeController::class, 'adminIndex']);
Route::post('/admin/users', [HomeController::class, 'storeUser'])->name('admin.users.store');
Route::delete('/admin/users/{id}', [HomeController::class, 'deleteUser'])->name('admin.users.delete');

Route::get('/users', [ApiController::class, 'users']);