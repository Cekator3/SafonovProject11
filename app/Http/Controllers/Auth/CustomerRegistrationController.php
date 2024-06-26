<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\DTOs\Auth\UserAuthDTO;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use Illuminate\Support\Facades\Auth;
use App\ViewModels\Auth\CustomerRegistrationViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Services\Auth\CustomerRegistrationService;

class CustomerRegistrationController
{
    /**
     * Shows user registration form
     */
    public function showRegistrationForm() : View
    {
        return view('auth.register');
    }

    private function retrieveDataFromRegistrationForm(Request $request) : CustomerRegistrationViewModel
    {
        $user = new CustomerRegistrationViewModel();
        $user->email        = $request->string('email', '');
        $user->password     = $request->string('password', '');
        $user->passwordConfirmation = $request->string('password_confirmation', '');
        $user->rememberUser = $request->boolean('remember_me', false);
        return $user;
    }

    private function loginUserViaCookies(UserAuthDTO $dataForAuth, bool $rememberUser) : void
    {
        Auth::login($dataForAuth->getObjectForCookieAuthentication(), $rememberUser);
        event(new Registered($dataForAuth->getObjectForCookieAuthentication()));
    }

    /**
     * Tries to register a customer
     */
    public function registerCustomer(Request $request) : RedirectResponse
    {
        $newUser = $this->retrieveDataFromRegistrationForm($request);
        $dataForAuth = null;
        $errors = new UserInputErrors();

        CustomerRegistrationService::registerCustomer($newUser, $dataForAuth, $errors);

        if ($errors->hasAny()) {
            return redirect()->back()
                             ->withErrors($errors->getAll())
                             ->withInput();
        }
        if ($dataForAuth === null)
            throw new Exception("Authentication data does not exist, but no errors have occurred");

        $this->loginUserViaCookies($dataForAuth, $newUser->rememberUser);

        // Redirect to email verification route
        return redirect()->route('verification.email.notice');
    }
}
