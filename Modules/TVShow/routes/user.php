<?php

use Illuminate\Support\Facades\Route;
use Modules\TVShow\App\Http\Controllers\TVShowController;


Route::post('/tv-shows/{tvShow}/follow-toggle', [TVShowController::class, 'toggle'])
    ->middleware('auth:user')
    ->name('user.tv-shows.follow-toggle');

Route::get('/tv-shows/{tvShow:slug}', [TvShowController::class, 'show'])
    ->name('tv-shows.show');
