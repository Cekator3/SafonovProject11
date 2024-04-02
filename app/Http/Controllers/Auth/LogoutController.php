<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\Auth\CustomerRegistrationDTO;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    private function logoutUser(Request $request) : void
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }

    /**
     * Logs the user out if he is logged in.
     */
    public function logout(Request $request) : RedirectResponse
    {
        $this->logoutUser($request);

        return redirect()->route('home');
    }

    /**
     * Logs the user out and deletes him from application.
     */
    public function cancelRegistration(Request $request) : RedirectResponse
    {
        $user = $request->user();
        $registrationData = new CustomerRegistrationDTO($user);

        $this->logoutUser($request);

        $user->forceDelete();

        return redirect()->route('register')
                         ->withInput($registrationData->getAll());
    }
}
