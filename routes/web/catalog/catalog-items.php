<?php

use App\Http\Controllers\Catalog\CatalogItemsController;
use App\Http\Middleware\EnsureCustomerCredentialsAreVerified;

Route::middleware([EnsureCustomerCredentialsAreVerified::class])
     ->prefix('catalog')
     ->controller(CatalogItemsController::class)
     ->group(function ()
{
    Route::get('/', 'showCatalogItems')
         ->name('catalog');

    Route::get('/search', 'searchCatalogItems')
         ->name('catalog.search');

    Route::get('/item/{baseModelId}', 'showCatalogItem')
         ->name('catalog.item');
});
