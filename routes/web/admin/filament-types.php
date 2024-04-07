<?php

use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\Admin\FilamentTypes\FilamentTypeUpdateController;
use App\Http\Controllers\Admin\FilamentTypes\FilamentTypeDeletionController;
use App\Http\Controllers\Admin\FilamentTypes\FilamentTypesListingController;
use App\Http\Controllers\Admin\FilamentTypes\FilamentTypesCreationController;

// Admin only
Route::middleware([Authenticate::class, EnsureIsAdmin::class])
     ->prefix('filament-types')
     ->group(function ()
{
    // Show the list of filament types
    Route::get('/', [FilamentTypesListingController::class, 'showFilamentTypes'])
         ->name('filament-types');
    /////


    // Create filament type
    Route::controller(FilamentTypesCreationController::class)
         ->group(function ()
    {
        Route::get('/create', 'showCreationForm')
             ->name('filament-types.create');
        Route::post('/create', 'createFilamentType');
    });
    /////


    // Update filament type
    Route::controller(FilamentTypeUpdateController::class)
         ->group(function ()
    {
        Route::get('/update/{id}', 'showUpdatingForm')
             ->name('filament-types.update');
        Route::patch('/update/{id}', 'updateFilamentType');
    });
    /////


    // Delete filament type
    Route::delete('/delete/{id}', [FilamentTypeDeletionController::class, 'deleteFilamentType'])
         ->name('filament-types.delete');
    /////
});
