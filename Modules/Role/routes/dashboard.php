<?php

use Illuminate\Support\Facades\Route;
use Modules\Role\App\Http\Controllers\Dashboard\RoleController;

Route::prefix('role')->as('role.')->group(function () {
    Route::get('datatable',  [RoleController::class, 'datatable'])->name('datatable');
});
Route::resource('role', RoleController::class);
