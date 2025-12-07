<?php
use Illuminate\Support\Facades\Route;
use Modules\TVShow\App\Http\Controllers\Api\TVShowController;

Route::apiResource('t-v-show', TVShowController::class);
