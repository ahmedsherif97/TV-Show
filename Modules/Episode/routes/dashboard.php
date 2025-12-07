<?php

use Illuminate\Support\Facades\Route;
use Modules\Episode\App\Http\Controllers\Dashboard\EpisodeController;

Route::prefix('episode')->as('episode.')->group(function () {
    Route::get('datatable', [EpisodeController::class, 'datatable'])->name('datatable');
    Route::get('{episode}/video', [EpisodeController::class, 'video'])
        ->name('video');

    Route::post('{episode}/video/upload', [EpisodeController::class, 'uploadVideo'])
        ->name('video.upload');

    Route::delete('{episode}/video/delete', [EpisodeController::class, 'deleteVideo'])
        ->name('video.delete');

    Route::post('{episode}/video/duration', [EpisodeController::class, 'updateDuration'])
        ->name('video.duration');

});
Route::resource('episode', EpisodeController::class);
