<?php

namespace App\Services\Auth;
use App\DTOs\Auth\UserAuthDTO;
use App\Errors\UserInputErrors;
use App\Repositories\Users\CustomerRepository;
use App\Services\UserCredentialsValidation\FormatValidation\EmailFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\PasswordFormatValidationService;

/**
 * A subsystem that attempts to login the user.
 */
class LoginService
{
    private static function validateUserCredentials(string $email,
                                                    string $password,
                                                    UserInputErrors $errors) : void
    {
        EmailFormatValidationService::validateEmail($email, $errors);
        PasswordFormatValidationService::validatePassword($password, $errors);
    }

    /**
     * Logs the user in.
     *
     * @param string $email The user's email.
     * @param string $password The user's password.
     * @param UserAuthDTO|null $dataForAuth It will contain data required for
     * authentication on the interface side (Web, API, etc.) if no errors occur.
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public static function loginUser(string $email,
                                     string $password,
                                     UserAuthDTO|null &$dataForAuth,
                                     UserInputErrors $errors) : void
    {
        static::validateUserCredentials($email, $password, $errors);

        if ($errors->hasAny())
            return;

        $dataForAuth = null;
        $customers = new CustomerRepository();
        $customers->findByAuthCredentials($email, $password, $dataForAuth);
        if ($dataForAuth === null)
        {
            $errMessage = __('auth.failed');
            $errors->add('email', $errMessage);
            return;
        }
    }
}
