<?php

use App\Http\Middleware\EnsureIsCustomer;
use App\Http\Middleware\EnsureCustomerCredentialsAreVerified;
use App\Http\Controllers\Orders\OrderedModels\OrderedModelRemoverController;
use App\Http\Controllers\Orders\OrderedModels\OrderedModelUpdaterController;
use App\Http\Controllers\Orders\OrderedModels\OrderedCatalogModelAdderController;

Route::middleware([EnsureIsCustomer::class, EnsureCustomerCredentialsAreVerified::class])
     ->prefix('shopping-cart')
     ->group(function ()
{
    // Add catalog model to the order
    Route::controller(OrderedCatalogModelAdderController::class)
         ->group(function ()
    {
        Route::get('/add/catalog-model/{baseModelId}', 'showAddCatalogModelToCartForm')
            ->name('shopping-cart.add.catalog-model');
        Route::put('/add/catalog-model/{baseModelId}', 'addCatalogModelToOrder');
    });

    // Update catalog model in the order
    Route::controller(OrderedModelUpdaterController::class)
         ->group(function ()
    {
        Route::get('/update/{baseModelId}', 'showUpdateModelForm')
            ->name('shopping-cart.update');
        Route::put('/update/{baseModelId}', 'updateOrderedModel');
    });

    // Remove catalog model from the order
    Route::controller(OrderedModelRemoverController::class)
         ->group(function ()
    {
        Route::get('/remove/{orderedModelId}', 'removeOrderedModel')
             ->name('shopping-cart.remove');
    });
});
