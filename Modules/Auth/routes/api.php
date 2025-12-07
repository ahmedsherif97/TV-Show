<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\Api\AuthController;

Route::prefix('auth')->group(function () {
    Route::post('login',  [AuthController::class, 'login']);
});
