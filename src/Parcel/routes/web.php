<?php

use Illuminate\Support\Facades\Route;
use \Src\Parcel\Controllers\ParcelAdminController;
use Src\Parcel\Controllers\ParcelAssignmentAdminController;

Route::group(['prefix' => 'admin/parcels', 'as' => 'admin.parcels.', 'middleware' => ['web', 'auth']], function () {
    Route::get('/', [ParcelAdminController::class, 'index'])->name('index');
    Route::get('/create', [ParcelAdminController::class, 'create'])->name('create');
    Route::get('/edit/{id}', [ParcelAdminController::class, 'edit'])->name('edit');
    Route::get('/show/{id}', [ParcelAdminController::class, 'view'])->name('view');
    Route::delete('/destory/{id}', [ParcelAdminController::class, 'destroy'])
        ->name('destroy');
});