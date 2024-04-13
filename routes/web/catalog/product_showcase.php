<?php

use App\Http\Middleware\EnsureCustomerCredentialsAreVerified;

Route::middleware([EnsureCustomerCredentialsAreVerified::class])
     ->controller(CatalogController::class)
     ->group(function ()
{
    Route::get('/catalog/{search?}', 'showCatalogItems')
         ->name('catalog');
});
