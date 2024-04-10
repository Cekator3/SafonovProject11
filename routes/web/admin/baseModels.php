<?php

use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\Admin\BaseModels\BaseModelsUpdateController;
use App\Http\Controllers\Admin\BaseModels\BaseModelsListingController;
use App\Http\Controllers\Admin\BaseModels\BaseModelsCreationController;
use App\Http\Controllers\Admin\BaseModels\BaseModelsDeletionController;
use App\Http\Controllers\Admin\BaseModels\BaseModelsPrintPricesUpdateController;

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

    Route::controller(BaseModelsPrintPricesUpdateController::class)
         ->group(function ()
    {
        Route::get('/update-prices/{id}', 'showUpdatingForm')
             ->name('base-models.update-prices');
        Route::patch('/update-prices/{id}', 'updateBaseModelPrintPrice');
    });
    /////


    // Delete base model
    Route::delete('/delete/{id}', [BaseModelsDeletionController::class, 'deleteBaseModel'])
         ->name('base-models.delete');
    /////
});
