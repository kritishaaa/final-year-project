<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Frontend\Courier\Home\Controller\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/user/register', [AuthController::class, 'showRegisterForm'])->name('showForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'customerLogin'])->name('customer.authenticate');
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::get('/', [HomeController::class, 'home'])->name('home');
// routes/web.php
Route::get('/track/{code}', [HomeController::class, 'search'])
    ->name('track.search');



Route::get('auth/login', [AuthController::class, 'login'])->name('login');
Route::post('auth/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');


Route::prefix('courier')->name('courier.')->group(function () {
    Route::get('/dashboard', function () {
        return view("customerDashboard");
    })->name('dashboard');

    Route::get('/change-password',[AuthController::class,'changePassword'])->name('change-password');
    Route::any('/logout', [AuthController::class, 'customerLogout'])->name('logout');
});

Route::get('admin/dashboard', DashboardController::class)->name('admin.dashboard');
Route::any('logout', [AuthController::class, 'logout'])->name('admin.logout');
