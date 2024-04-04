<?php

use App\Http\Middleware\EnsureIsCustomer;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\Customer\CustomerProfileController;
use App\Http\Middleware\EnsureCustomerCredentialsAreVerified;

// Customers only
Route::middleware([Authenticate::class, EnsureIsCustomer::class, EnsureCustomerCredentialsAreVerified::class])
     ->controller(CustomerProfileController::class)
     ->group(function ()
{
    Route::get('/profile', 'showCustomerProfile')
         ->name('customer-profile');
    Route::patch('/profile', 'updateCustomerProfile');
});
