<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function ($prefix) {
    Route::get('/', function () {
        return redirect()->route('admin.login');
    })->name('index');
    Auth::routes(['logout' => false, 'verify' => true]);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('change/password', [ChangePasswordController::class, 'changePassword'])->name('password.change');
    Route::post('change/password', [ChangePasswordController::class, 'doChangePassword'])->name('password.doChange');
});

// Add password reset routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Email Verification Routes ------------------------------------------------------------------------------

Route::get('/email/verify', function () {
    return view('auth.verify'); // create this Blade file if missing
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill(); // marks the email as verified
    return redirect('/dashboard')->with('alert-success', 'تم تأكيد البريد الإلكتروني بنجاح');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//----------------------------------------------------------------------------------------------------------

Route::get('/', [HomeController::class, 'index'])->name('home');
