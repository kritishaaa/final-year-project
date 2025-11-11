<?php

use Illuminate\Support\Facades\Route;
use \Src\Courier\Controllers\CourierAdminController;

Route::group(['prefix' => 'admin/couriers', 'as' => 'admin.couriers.', 'middleware' => ['web', 'auth']], function () {
    Route::get('/', [CourierAdminController::class, 'index'])->name('index');
    Route::get('/create', [CourierAdminController::class, 'create'])->name('create');
    Route::get('/edit/{id}', [CourierAdminController::class, 'edit'])->name('edit');
});
