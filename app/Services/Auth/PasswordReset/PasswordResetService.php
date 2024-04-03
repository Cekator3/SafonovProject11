<?php

namespace App\Services\Auth\PasswordReset;
use App\Models\User;
use App\Errors\UserInputErrors;
use App\Repositories\Users\CustomerRepository;
use App\ViewModels\Auth\CustomerResetPasswordCredentials;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Services\UserCredentialsValidation\FormatValidation\EmailFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\PasswordFormatValidationService;

class PasswordResetService
{
    private static function validateToken(string $token, UserInputErrors $errors) : void
    {
        if ($token === '')
        {
            $errMessage = __('validation.required', ['attribute' => 'token']);
            $errors->add('token', $errMessage);
        }
    }

    private static function validateUserInput(CustomerResetPasswordCredentials $userCredentials,
                                              UserInputErrors $errors) : void
    {
        $token = $userCredentials->getToken();
        $email = $userCredentials->getEmail();
        $password = $userCredentials->getPassword();
        $passwordConfirmation = $userCredentials->getPasswordConfirmation();

        static::validateToken($token, $errors);
        EmailFormatValidationService::validateEmail($email, $errors);
        PasswordFormatValidationService::validatePassword($password,
                                                          $errors,
                                                          $passwordConfirmation,
                                                          true
        );
    }

    private static function resetPassword(CustomerResetPasswordCredentials $userCredentials,
                                          UserInputErrors $errors) : void
    {
        $status = Password::Reset($userCredentials->getAll(), function (User $customer, string $password)
        {
            $customers = new CustomerRepository();
            $customers->changePassword($customer, $password);
            event(new PasswordReset($customer));
        });

        if ($status !== Password::PASSWORD_RESET)
            $errors->add('status', __($status));
    }

    /**
     * Resets user's password.
     *
     * @param CustomerResetPasswordCredentials $userCredentials Customer's data for resetting password
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public static function resetByEmail(CustomerResetPasswordCredentials $userCredentials,
                                                UserInputErrors $errors) : void
    {
        static::validateUserInput($userCredentials, $errors);
        if ($errors->hasAny())
            return;

        static::resetPassword($userCredentials, $errors);
    }
}
