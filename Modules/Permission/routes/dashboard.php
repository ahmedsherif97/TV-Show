<?php

use Illuminate\Support\Facades\Route;
use Modules\Permission\App\Http\Controllers\Dashboard\PermissionController;

Route::prefix('permission')->as('permission.')->group(function () {
    Route::get('datatable',  [PermissionController::class, 'datatable'])->name('datatable');
});
Route::resource('permission', PermissionController::class);
