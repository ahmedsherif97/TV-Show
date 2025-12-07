<?php

use Illuminate\Support\Facades\Route;
use Modules\Media\App\Http\Controllers\Dashboard\MediaController;

Route::prefix('media')->as('media.')->group(function () {
    Route::get('datatable',  [MediaController::class, 'datatable'])->name('datatable');
    Route::post('upload',  [MediaController::class, 'upload'])->name('upload');
});
Route::resource('media', MediaController::class);
