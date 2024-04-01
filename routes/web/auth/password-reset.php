<?php

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Auth\PasswordReset\NewPasswordController;
use App\Http\Controllers\Auth\PasswordReset\PasswordResetLinkController;

Route::middleware(RedirectIfAuthenticated::class)->group(function ()
{
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
});
