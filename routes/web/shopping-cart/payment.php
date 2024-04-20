<?php

use App\Http\Controllers\Orders\OrderPaymentController;
use App\Http\Middleware\EnsureIsCustomer;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Middleware\EnsureCustomerCredentialsAreVerified;

Route::middleware([Authenticate::class, EnsureIsCustomer::class, EnsureCustomerCredentialsAreVerified::class])
     ->prefix('shopping-cart/payment')
     ->controller(OrderPaymentController::class)
     ->group(function ()
{
    Route::get('/', 'showPaymentNotifier')
         ->name('shopping-cart.payment');
});
