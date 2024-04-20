<?php

use App\Http\Controllers\Admin\Orders\OrdersListingController;
use App\Http\Controllers\Admin\Orders\OrdersStatusSetterController;
use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Auth\Middleware\Authenticate;

// Admin only
Route::middleware([Authenticate::class, EnsureIsAdmin::class])
     ->prefix('orders')
     ->group(function ()
{
    Route::controller(OrdersListingController::class)
         ->group(function ()
    {
        // Show the list of orders
        Route::get('/', 'showOrders')->name('admin.orders.listing');

        // Show the order's details
        Route::get('/{orderId}', 'showOrderDetails')->name('admin.orders.orderDetails');
    });


    // Set order's status
    Route::put('/', [OrdersStatusSetterController::class, 'setOrderStatus'])
         ->name('admin.orders.setStatus');
    /////
});
