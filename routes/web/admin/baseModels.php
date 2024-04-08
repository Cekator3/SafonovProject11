<?php

use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Auth\Middleware\Authenticate;

// Admin only
Route::middleware([Authenticate::class, EnsureIsAdmin::class])
     ->prefix('models')
     ->group(function ()
{
    // Show the list of base models
    Route::get('/', [BaseModelsListingController::class, 'showBaseModels'])
         ->name('base-models');
    /////


    // Create base model
    Route::controller(BaseModelsCreationController::class)
         ->group(function ()
    {
        Route::get('/create', 'showCreationForm')
             ->name('base-models.create');
        Route::post('/create', 'createBaseModel');
    });
    /////


    // Update base model
    Route::controller(BaseModelsUpdateController::class)
         ->group(function ()
    {
        Route::get('/update/{id}', 'showUpdatingForm')
             ->name('base-models.update');
        Route::patch('/update/{id}', 'updateBaseModel');
    });
    /////


    // Delete base model
    Route::delete('/delete/{id}', [BaseModelDeletionController::class, 'deleteBaseModel'])
         ->name('base-models.delete');
    /////
});
