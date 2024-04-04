<?php
use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Auth\Middleware\Authenticate;

// Admin only
Route::middleware([Authenticate::class, EnsureIsAdmin::class])
     ->prefix('additional-services')
     ->group(function ()
{
    // Show the list of additional services
    Route::get('/', 'showAdditionalServices')
         ->controller([ListAdditionalServicesController::class])
         ->name('additional-services');
    /////


    // Create additional service
    Route::controller([CreateAdditionalServicesController::class])
         ->group(function ()
    {
        Route::get('/create', 'showCreationForm')
            ->name('additional-services.create');

        Route::post('/create', 'createAdditionalService');
    });
    /////


    // Update additional service
    Route::controller([UpdateAdditionalServicesController::class])
         ->group(function ()
    {
        Route::get('/update/{additionalService}', 'showUpdateForm')
            ->name('additional-services.update');

        Route::patch('/update/{additionalService}', 'updateAdditionalService');
    });
    /////


    // Delete additional service
    Route::delete('/delete/{additionalService}', 'deleteAdditionalService')
         ->controller(DeleteAdditionalServiceController::class);
    /////
});
