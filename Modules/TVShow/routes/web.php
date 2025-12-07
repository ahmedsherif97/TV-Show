<?php

use Illuminate\Support\Facades\Route;
use Modules\TVShow\App\Http\Controllers\TVShowController;

Route::resource('t-v-show', TVShowController::class);
