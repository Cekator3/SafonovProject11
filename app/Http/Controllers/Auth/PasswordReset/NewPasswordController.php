<?php

namespace App\Http\Controllers\Auth\PasswordReset;

use App\Services\Auth\PasswordReset\PasswordResetService;
use App\ViewModels\Auth\CustomerResetPasswordCredentials;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class NewPasswordController extends Controller
{
    /**
     * Displays a password reset form.
     */
    public function showResetPasswordForm(Request $request, string $token) : View
    {
        $email = $request->input("email", '');
        $viewData = [
            'token' => $token,
            'email' => $email,
        ];
        return view('auth.ResetPassword.reset-password', $viewData);
    }

    /**
     * Resets user's password.
     */
    public function resetUserPassword(Request $request) : RedirectResponse
    {
        $token = $request->input('token', '');
        $email = $request->input('email', '');
        $password = $request->input('password', '');
        $passwordConfirmation = $request->input('password_confirmation', '');
        $userCredentials = new CustomerResetPasswordCredentials($token, 
                                                                $email, 
                                                                $password, 
                                                                $passwordConfirmation);
        $errors = new UserInputErrors();

        PasswordResetService::resetPasswordByEmail($userCredentials, $errors);

        if ($errors->hasAny()) {
            return redirect()->back()
                             ->withErrors($errors->getAll())
                             ->withInput();
        }

        return redirect()->route('login')->with('status', __('passwords.reset'));
    }
}
