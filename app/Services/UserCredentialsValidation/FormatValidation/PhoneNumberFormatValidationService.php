<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Errors\UserInputErrors;
use libphonenumber\PhoneNumberUtil;
use Illuminate\Support\Facades\Config;

/**
 * Subsystem for checking whether an user password can exist.
 * 
 * This is useful to avoid even trying to send sms to a 
 * non-existent phone number.
 */
class PhoneNumberFormatValidationService
{
    private static function validateLength(string $phoneNumber, UserInputErrors $errors) : void
    {
        $len = strlen($phoneNumber);
        if ($len === 0)
        {
            $errMessage = __('validation.required', ['attribute' => 'phone_number']);
            $errors->add('phone_number', $errMessage);
            return;
        }
        $maxLen = Config::get('users.credentials.max_phone_number_length');
        if ($len > $maxLen)
        {
            $errMessage = __('validation.max.string', ['attribute' => 'phone number', 
                                                       'max' => $maxLen]);
            $errors->add('phone_number', $errMessage);
            return;
        }
    }

    private static function isFormatValid(string $phoneNumber) : bool
    {
        return PhoneNumberUtil::getInstance()->isPossibleNumber($phoneNumber, 'RU');
    }

    private static function validateFormat(string $phoneNumber, 
                                                      UserInputErrors $errors) : void
    {
        if (static::isFormatValid($phoneNumber)) 
            return;
        $errMessage = __('validation.phone_number');
        $errors->add('phone_number', $errMessage);
    }

    /**
     * Seeks errors in the phone number.
     *
     * @param UserInputErrors $errors 
     * Data structure, where discovered errors will be stored.
     */
    public static function validatePhoneNumber(string $phoneNumber, UserInputErrors $errors) : void
    {
        static::validateLength($phoneNumber, $errors);
        if ($errors->hasAnyForInput('phone_number'))
            return;
        static::validateFormat($phoneNumber, $errors);
    }
}
