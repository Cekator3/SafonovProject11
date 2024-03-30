<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Errors\UserInputErrors;
use Illuminate\Support\Facades\Config;

/**
 * Subsystem for checking whether an human name can exist.
 */
class HumanNameFormatValidationService
{
    private static function validateLength(string $name, UserInputErrors $errors) : void
    {
        $len = mb_strlen($name, 'UTF-8');
        $maxLen = Config::get('users.credentials.max_human_name_length');
        if ($len > $maxLen)
        {
            $errMessage = __('validation.max.string', ['attribute' => 'name', 
                                                       'max' => $maxLen]);
            $errors->add('name', $errMessage);
            return;
        }
    }

    /**
     * Seeks errors in the human name.
     * 
     * @param UserInputErrors $errors 
     * Data structure, where discovered errors will be stored.
     */
    public static function validateName(string $name, UserInputErrors $errors) : void
    {
        static::validateLength($name, $errors);
    }
}
