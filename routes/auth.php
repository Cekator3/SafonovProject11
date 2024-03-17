<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Auth\CustomerRegistrationController;
use App\Http\Controllers\Auth\PasswordReset\NewPasswordController;
use App\Http\Controllers\Auth\PasswordReset\PasswordResetLinkController;


Route::middleware(RedirectIfAuthenticated::class)->group(function ()
{    
    ////////////////////////////////////////////////////////////////
    // First part of signup - email verification
    ////////////////////////////////////////////////////////////////
    Route::get('/start-signup', [EmailVerificationController::class, 
                                 'showEmailVerificationForm'])
         ->name('register');

    Route::post('/start-signup', [EmailVerificationController::class, 
                                 'sendVerificationMail']);
    ////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////
    // Last part of signup - creating account
    ////////////////////////////////////////////////////////////////
    Route::controller(CustomerRegistrationController::class)->group(function () 
    {
        Route::get('/complete-signup', 'showRegistrationForm');
        Route::post('/complete-signup', 'registerCustomer');
    });
    ////////////////////////////////////////////////////////////////


    // Login
    Route::controller(LoginController::class)->group(function ()
    {
        Route::get('/login', 'showLoginForm')
             ->name('login');
        Route::post('/login', 'login');
    });


    ////////////////////////////////////////////////////////////////
    // Password reset routes
    ////////////////////////////////////////////////////////////////
    Route::controller(PasswordResetLinkController::class)->group(function ()
    {
        Route::get('forgot-password', 'showForgotPasswordForm')
             ->name('password.request');

        Route::post('forgot-password', 'sendPasswordResetLink')
             ->name('password.email');
    });

    Route::controller(NewPasswordController::class)->group(function ()
    {
        Route::get('reset-password/{token}', 'showResetPasswordForm')
             ->name('password.reset');

        Route::post('reset-password', 'resetUserPassword')
             ->name('password.store');
    });
    ////////////////////////////////////////////////////////////////

});

Route::middleware('auth')->group(function ()
{
    Route::get('/logout', [LogoutController::class, 'logout'])
         ->name('logout');
});
