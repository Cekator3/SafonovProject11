<?php

use App\Http\Middleware\EnsureIsCustomer;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\Customer\UserProfileController;
use App\Http\Middleware\EnsureCustomerCredentialsAreVerified;

// Customers only
Route::middleware([Authenticate::class, EnsureIsCustomer::class, EnsureCustomerCredentialsAreVerified::class])
     ->controller(UserProfileController::class)
     ->group(function ()
{
    Route::get('/profile', 'showUserProfile')
         ->name('user-profile');
    Route::put('/profile', 'updateUserInfo');
});
