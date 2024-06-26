<?php

namespace App\Services\Auth\PasswordReset;
use App\Errors\UserInputErrors;
use Illuminate\Support\Facades\Password;
use App\Repositories\Users\UserRepository;
use App\Services\UserCredentialsValidation\FormatValidation\EmailFormatValidationService;

class PasswordResetLinkSenderService
{
    private static function normalizeEmail(string $email) : string
    {
        $users = new UserRepository();
        return $users->normalizeEmail($email);
    }

    /**
     * Sends a reset password link to user's email.
     * @param string $email The user's email
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public static function send(string $email, UserInputErrors $errors) : void
    {
        // TODO only customers should be able to reset their password
        EmailFormatValidationService::validateEmail($email, $errors);
        if ($errors->hasAny())
            return;

        $normalizedEmail = static::normalizeEmail($email);

        $status = Password::sendResetLink(['email' => $normalizedEmail]);
        if ($status !== Password::RESET_LINK_SENT)
            $errors->add('email', __($status));
    }
}
