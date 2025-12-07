<?php
use Illuminate\Support\Facades\Route;
use Modules\Media\App\Http\Controllers\Api\MediaController;

Route::apiResource('media', MediaController::class);
