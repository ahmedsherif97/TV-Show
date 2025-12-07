<?php

use Illuminate\Support\Facades\Route;
use Modules\Episode\App\Http\Controllers\EpisodeController;

Route::get('/episodes/{episode:slug}', [EpisodeController::class, 'show'])
    ->name('episodes.show')->middleware('auth:user');

Route::post('/episodes/{episode}/like-toggle', [EpisodeController::class, 'toggle'])
    ->name('user.episodes.like-toggle');