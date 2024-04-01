<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Auth\CustomerRegistrationController;

Route::middleware(RedirectIfAuthenticated::class)->group(function ()
{
    Route::controller(CustomerRegistrationController::class)->group(function () 
    {
        Route::get('/signup', 'showRegistrationForm')
            ->name('register');
        Route::post('/signup', 'registerCustomer');
    });

    Route::controller(LoginController::class)->group(function ()
    {
        Route::get('/login', 'showLoginForm')
             ->name('login');
        Route::post('/login', 'login');
    });
});

Route::middleware('auth')->group(function ()
{
    Route::controller(LogoutController::class)->group(function ()
    {
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/cancel-registration', 'cancelRegistration')->name('cancel.registration');
    });
});

require __DIR__.'/email-verification.php';
require __DIR__.'/password-reset.php';
