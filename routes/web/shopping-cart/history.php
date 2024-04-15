<?php

use App\Http\Middleware\EnsureIsCustomer;
use App\Http\Controllers\Orders\OrdersHistoryController;
use App\Http\Middleware\EnsureCustomerCredentialsAreVerified;

Route::middleware([EnsureIsCustomer::class, EnsureCustomerCredentialsAreVerified::class])
     ->prefix('/shopping-cart/history')
     ->controller(OrdersHistoryController::class)
     ->group(function ()
{
    Route::get('/', 'showOrdersHistory');
    Route::get('/{orderId}', 'showOrderDetails');
});
