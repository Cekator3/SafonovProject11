<?php

use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\Admin\AdditionalServices\AdditionalServicesListingController;
use App\Http\Controllers\Admin\AdditionalServices\AdditionalServiceDeletionController;
use App\Http\Controllers\Admin\AdditionalServices\AdditionalServicesCreationController;
use App\Http\Controllers\Admin\AdditionalServices\AdditionalServicesUpdateController;

// Admin only
Route::middleware([Authenticate::class, EnsureIsAdmin::class])
     ->prefix('additional-services')
     ->group(function ()
{
    // Show the list of additional services
    Route::get('/', [AdditionalServicesListingController::class, 'showAdditionalServices'])
         ->name('additional-services');
    /////


    // Create additional service
    Route::controller(AdditionalServicesCreationController::class)
         ->group(function ()
    {
        Route::get('/create', 'showCreationForm')
             ->name('additional-services.create');
        Route::post('/create', 'createAdditionalService');
    });
    /////


    // Update additional service
    Route::controller(AdditionalServicesUpdateController::class)
         ->group(function ()
    {
        Route::get('/update/{id}', 'showUpdatingForm')
             ->name('additional-services.update');
        Route::patch('/update/{id}', 'updateAdditionalService');
    });
    /////


    // Delete additional service
    Route::delete('/delete/{id}', [AdditionalServiceDeletionController::class, 'deleteAdditionalService'])
         ->name('additional-services.delete');
    /////
});
