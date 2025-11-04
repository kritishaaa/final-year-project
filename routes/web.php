<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/user/register', [AuthController::class, 'showRegisterForm'])->name('showForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');
// Route::get('/login', [FrontController::class, 'login'])->name('digital-service');
Route::post('/login', [AuthController::class, 'customerLogin'])->name('customer.authenticate');
// Route::get('/services', [FrontController::class, 'services'])->name('services');
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');


Route::get('auth/login', [AuthController::class, 'login'])->name('login');
Route::post('auth/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');


// Route::prefix('admin')
//     ->as('admin.')
//     ->group(function () {
        Route::get('dashboard', DashboardController::class)->name('admin.dashboard');
        Route::any('logout', [AuthController::class, 'logout'])->name('admin.logout');
    // });