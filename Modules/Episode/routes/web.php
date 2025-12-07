<?php

use Illuminate\Support\Facades\Route;
use Modules\Episode\App\Http\Controllers\EpisodeController;

Route::resource('episode', EpisodeController::class);
