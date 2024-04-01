<?php

use App\Http\Middleware\RedirectIfEmailDontNeedToBeVerified;
use App\Http\Controllers\Auth\EmailVerification\EmailVerificationHandlerController;
use App\Http\Controllers\Auth\EmailVerification\EmailVerificationNotifierController;

Route::middleware('auth')->group(function ()
{
    ////////////////////////////////////////////////////////////////
    //Email verification routes
    ////////////////////////////////////////////////////////////////
    Route::middleware(RedirectIfEmailDontNeedToBeVerified::class)->group(function() 
    {
        Route::controller(EmailVerificationNotifierController::class)->group(function ()
        {
            Route::get('/email/verify', 'showEmailVerificationNotifier')
                ->name('verification.email.notice');

            Route::post('/email/resend-verification', 'resendEmailVerification')
                 ->middleware('throttle:6,1')
                ->name('verification.email.send');
        });

        Route::get('/email/verify/{id}/{hash}', [EmailVerificationHandlerController::class,
                                                'handleEmailVerification'])
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');
    });
    ////////////////////////////////////////////////////////////////

});
