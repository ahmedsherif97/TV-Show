<?php

use Illuminate\Support\Facades\Route;
use Modules\Notification\App\Http\Controllers\Dashboard\NotificationController;

Route::prefix('notification')->as('notification.')->group(function () {
    Route::get('datatable',  [NotificationController::class, 'datatable'])->name('datatable');
});
Route::resource('notification', NotificationController::class);
