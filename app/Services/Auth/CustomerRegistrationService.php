<?php

namespace App\Services\Auth;

use App\DTOs\Auth\UserAuthDTO;
use App\Errors\UserInputErrors;
use App\Repositories\Users\CustomerRepository;
use App\ViewModels\Auth\CustomerRegistrationViewModel;
use App\Errors\UserCredentialsUniquenessErrors;
use App\Services\UserCredentialsValidation\FormatValidation\EmailFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\PasswordFormatValidationService;

/**
 * A subsystem that registers new customers in the application.
 */
class CustomerRegistrationService
{
    private static function validateCredentials(CustomerRegistrationViewModel $user,
                                                UserInputErrors $errors) : void
    {
        EmailFormatValidationService::validateEmail($user->email, $errors);
        PasswordFormatValidationService::validatePassword($user->password,
                                                          $errors,
                                                          $user->passwordConfirmation,
                                                          true);
    }

    private static function saveNewCustomer(CustomerRegistrationViewModel $customer,
                                           UserAuthDTO|null &$dataForAuth,
                                           UserInputErrors $errors) : void
    {
        $userUniquenessErrors = new UserCredentialsUniquenessErrors();

        $customers = new CustomerRepository();
        $customers->add($customer, $dataForAuth, $userUniquenessErrors);

        if ($userUniquenessErrors->isEmailInUse())
        {
            $errMessage = __('validation.unique', ['attribute' => 'email']);
            $errors->add('email', $errMessage);
        }
    }

    /**
     * Registers the new customer.
     *
     * @param CustomerRegistrationViewModel $customer The customer's data.
     * @param UserAuthDTO|null $dataForAuth It will contain data required for
     * authentication * on the interface side (Web, API, etc.) if no errors occur.
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     * @return void
     */
    public static function registerCustomer(CustomerRegistrationViewModel $customer,
                                            UserAuthDTO|null &$dataForAuth,
                                            UserInputErrors $errors) : void
    {
        static::validateCredentials($customer, $errors);
        if ($errors->hasAny())
            return;

        $dataForAuth = null;
        static::saveNewCustomer($customer, $dataForAuth, $errors);
    }
}
