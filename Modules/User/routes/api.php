<?php

use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\Api\UserController;

Route::prefix('user')->as('user.')->group(function () {
    Route::post('avatar',  [UserController::class, 'uploadAvatar'])->name('avatar.upload');
    Route::get('datatable',  [UserController::class, 'datatable'])->name('datatable');
});
Route::apiResource('user', UserController::class)->names('api.user');
