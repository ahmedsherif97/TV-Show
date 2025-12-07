<?php

use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\Dashboard\ProfileController;
use Modules\User\App\Http\Controllers\Dashboard\UserController;

Route::prefix('user')->as('user.')->group(function () {
    Route::get('datatable', [UserController::class, 'datatable'])->name('datatable');
});
Route::resource('user', UserController::class)->only('index');
Route::get('user/{user}/roles', [UserController::class, 'roles'])->name('user.roles');
Route::post('user/{user}/roles', [UserController::class, 'updateRoles']);