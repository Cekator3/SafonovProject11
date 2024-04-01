<?php

use App\Http\Middleware\EnsureIsCustomer;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Middleware\EnsureCustomerCredentialsAreVerified;

// Customers only
Route::middleware([Authenticate::class, EnsureIsCustomer::class, EnsureCustomerCredentialsAreVerified::class])
     ->controller(UserProfile::class)
     ->group(function () 
{
    Route::get('/profile', 'showUserProfile');
    Route::put('/profile', 'updateUserInfo');
});
