<?php

namespace App\Http\Controllers\Auth\EmailVerification;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DTOs\Auth\CredentialsVerification\EmailVerificationDTO;

class EmailVerificationNotifierController extends Controller
{
    private function setVerificationResendingStatus(Request $request, bool $isResent) : void
    {
        session()->put('email_verification_resent', $isResent);
    }

    private function getVerificationResendingStatus(Request $request) : bool
    {
        return session()->get('email_verification_resent', false);
    }

    /**
     * Prompts the user to validate his email.
     */
    public function showEmailVerificationNotifier(Request $request) : View
    {
        $email = $request->user()->email;
        $isVerificationResent = $this->getVerificationResendingStatus($request);

        $dto = new EmailVerificationDTO($email, $isVerificationResent);

        $this->setVerificationResendingStatus($request, false);

        return view('auth.verify-email', ['emailVerification' => $dto]);
    }

    /**
     * Resends the email verification email to the user.
     */
    public function resendEmailVerification(Request $request) : RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();

        $this->setVerificationResendingStatus($request, true);

        return redirect()->back();
    }
}
