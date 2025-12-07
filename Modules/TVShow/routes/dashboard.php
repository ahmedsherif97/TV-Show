<?php

use Illuminate\Support\Facades\Route;
use Modules\TVShow\App\Http\Controllers\Dashboard\TVShowController;

Route::prefix('show')->as('show.')->group(function () {
    Route::get('datatable',  [TVShowController::class, 'datatable'])->name('datatable');
});
Route::resource('show', TVShowController::class);
