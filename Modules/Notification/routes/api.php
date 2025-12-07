<?php
use Illuminate\Support\Facades\Route;
use Modules\Notification\App\Http\Controllers\Api\NotificationController;

Route::apiResource('notification', NotificationController::class);
