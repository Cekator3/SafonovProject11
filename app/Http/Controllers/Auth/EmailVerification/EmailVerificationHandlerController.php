<?php

namespace App\Http\Controllers\Auth\EmailVerification;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationHandlerController extends Controller
{
    /**
     * Completes the verification of the user's email address.
     */
    public function handleEmailVerification(EmailVerificationRequest $request) : RedirectResponse
    {
        $request->fulfill();
     
        return redirect()->route('home');
    }
}
