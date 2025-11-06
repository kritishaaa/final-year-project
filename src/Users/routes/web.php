<?php

use Illuminate\Support\Facades\Route;
use \Src\Users\Controllers\UserAdminController;

Route::group(['prefix' => 'admin/users', 'as' => 'admin.users.', 'middleware' => ['web', 'auth']], function () {
    Route::get('/', [UserAdminController::class, 'index'])->name('index');
    Route::get('/create', [UserAdminController::class, 'create'])->name('create');
    Route::get('/edit/{id}', [UserAdminController::class, 'edit'])->name('edit');
});
