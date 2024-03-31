<?php

namespace App\Services\Auth;

use App\DTOs\Auth\UserAuthDTO;
use App\Errors\UserInputErrors;
use App\Repositories\UserRepository;
use App\ViewModels\CustomerViewModel;
use App\Errors\UserCredentialsUniquenessErrors;
use App\Services\UserCredentialsValidation\FormatValidation\EmailFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\PasswordFormatValidationService;

/**
 * A subsystem that registers new customers in the application.
 */
class CustomerRegistrationService
{
    private static function validateCustomerCredentials(CustomerViewModel $user,
                                                        UserInputErrors $errors) : void
    {
        EmailFormatValidationService::validateEmail($user->email, $errors);
        PasswordFormatValidationService::validatePassword($user->password, 
                                                          $errors, 
                                                          $user->passwordConfirmation, 
                                                          true);
    }

    private static function saveNewCustomerDataInRepository(CustomerViewModel $customer, 
                                                            UserAuthDTO|null &$dataForAuth,
                                                            UserInputErrors $errors) : void
    {
        $userUniquenessErrors = new UserCredentialsUniquenessErrors();

        UserRepository::addCustomer($customer, $dataForAuth, $userUniquenessErrors);

        if ($userUniquenessErrors->isEmailInUse())
        {
            $errMessage = __('validation.unique', ['attribute' => 'email']);
            $errors->add('email', $errMessage);
        }
    }

    /**
     * Registers the new customer.
     * 
     * @param CustomerViewModel $customer The customer's data.
     * @param UserAuthDTO|null $dataForAuth It will contain data required for 
     * authentication * on the interface side (Web, API, etc.) if no errors occur. 
     * @param UserInputErrors $errors 
     * User's inputs errors that prevented successful execution of the action.
     * @return void
     */
    public static function registerCustomer(CustomerViewModel $customer, 
                                            UserAuthDTO|null &$dataForAuth,
                                            UserInputErrors $errors) : void
    {
        static::validateCustomerCredentials($customer, $errors);
        if ($errors->hasAny())
            return;

        $dataForAuth = null;
        static::saveNewCustomerDataInRepository($customer, $dataForAuth, $errors);
    }
}
