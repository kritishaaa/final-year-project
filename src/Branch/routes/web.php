<?php

use Illuminate\Support\Facades\Route;
use \Src\Branch\Controllers\BranchAdminController;

Route::group(['prefix' => 'admin/branches', 'as' => 'admin.branches.', 'middleware' => ['web', 'auth']], function () {
    Route::get('/', [BranchAdminController::class, 'index'])->name('index');
    Route::get('/create', [BranchAdminController::class, 'create'])->name('create');
    Route::get('/edit/{id}', [BranchAdminController::class, 'edit'])->name('edit');
});
