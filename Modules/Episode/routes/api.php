<?php
use Illuminate\Support\Facades\Route;
use Modules\Episode\App\Http\Controllers\Api\EpisodeController;

Route::apiResource('episode', EpisodeController::class);
