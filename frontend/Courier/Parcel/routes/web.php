<?php

use Frontend\Courier\Parcel\Controller\ParcelController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'courier/parcels', 'as' => 'courier.parcels.', 'middleware' => ['web', 'auth']], function () {
    Route::get('/assigned', [ParcelController::class, 'assigned'])->name('assign');
    Route::get('/all', [ParcelController::class, 'index'])->name('index');
    Route::get('/show/{id}', [ParcelController::class, 'view'])->name('view');
});
