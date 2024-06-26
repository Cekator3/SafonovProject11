<?php

namespace App\Http\Controllers\Auth\PasswordReset;

use App\Services\Auth\PasswordReset\PasswordResetLinkSenderService;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use Illuminate\Http\RedirectResponse;

class PasswordResetLinkController
{
    /**
     * Displays a form to retrieve the user's credentials (email) for password reset.
     */
    public function showForgotPasswordForm() : View
    {
        return view('auth.reset-password.forgot-password');
    }

    /**
     * Sends a reset link to the registered user's email address.
     */
    public function sendPasswordResetLink(Request $request) : RedirectResponse
    {
        $email = $request->input('email', '');
        $errors = new UserInputErrors();

        PasswordResetLinkSenderService::send($email, $errors);

        if ($errors->hasAny()) {
            return redirect()->back()
                             ->withErrors($errors->getAll())
                             ->withInput();
        }

        return redirect()->back()
                         ->with('status', __('passwords.sent'))
                         ->withInput();
    }
}
