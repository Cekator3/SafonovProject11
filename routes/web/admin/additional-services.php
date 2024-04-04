<?php

use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\Admin\AdditionalServices\ListAdditionalServicesController;
use App\Http\Controllers\Admin\AdditionalServices\DeleteAdditionalServiceController;
use App\Http\Controllers\Admin\AdditionalServices\CreateAdditionalServicesController;
use App\Http\Controllers\Admin\AdditionalServices\UpdateAdditionalServicesController;

// Admin only
Route::middleware([Authenticate::class, EnsureIsAdmin::class])
     ->prefix('additional-services')
     ->group(function ()
{
    // Show the list of additional services
    Route::get('/', [ListAdditionalServicesController::class, 'showAdditionalServices'])
         ->name('additional-services');
    /////


    // Create additional service
    Route::controller(CreateAdditionalServicesController::class)
         ->group(function ()
    {
        Route::get('/create', 'showCreationForm');
        Route::post('/create', 'createAdditionalService');
    });
    /////


    // Update additional service
    Route::controller(UpdateAdditionalServicesController::class)
         ->group(function ()
    {
        Route::get('/update/{id}', 'showUpdatingForm');
        Route::patch('/update/{id}', 'updateAdditionalService');
    });
    /////


    // Delete additional service
    Route::delete('/delete/{id}', [DeleteAdditionalServiceController::class, 'deleteAdditionalService']);
    /////
});
