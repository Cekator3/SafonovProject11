<?php

use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Auth\Middleware\Authenticate;

// Admin only
Route::middleware([Authenticate::class, EnsureIsAdmin::class])
     ->prefix('printing-technologies')
     ->group(function ()
{
    // Show the list of printing technologies
    Route::get('/', [PrintingTechnologiesListingController::class, 'showPrintingTechnologies'])
         ->name('printing-technologies');
    /////


    // Create printing technology
    Route::controller(PrintingTechnologiesCreationController::class)
         ->group(function ()
    {
        Route::get('/create', 'showCreationForm')
             ->name('printing-technologies.create');
        Route::post('/create', 'createPrintingTechnology');
    });
    /////


    // Update printing technology
    Route::controller(PrintingTechnologiesUpdateController::class)
         ->group(function ()
    {
        Route::get('/update/{id}', 'showUpdatingForm')
             ->name('printing-technologies.update');
        Route::patch('/update/{id}', 'updatePrintingTechnology');
    });
    /////


    // Delete printing technology
    Route::delete('/delete/{id}', [PrintingTechnologiesDeletionController::class, 'deletePrintingTechnology'])
         ->name('printing-technologies.delete');
    /////
});
