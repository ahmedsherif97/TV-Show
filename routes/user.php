<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserAuth\ForgotPasswordController;
use App\Http\Controllers\UserAuth\RegisterController;
use App\Http\Controllers\UserAuth\ResetPasswordController;
use App\Http\Controllers\UserAuth\VerificationController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserAuth\LoginController;

Route::middleware('guest:user')->group(function () {
    // Login
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit');

    // Register
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.submit');

    // Password Reset
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// ======================= Authenticated Routes =======================
Route::middleware(['auth:user'])->group(function () {
    // Logout
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

});



Route::get('/search', [SearchController::class, 'index'])
    ->name('search');


