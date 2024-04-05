<?php

namespace App\Services\Admin\AdditionalServices\UserInputValidation;
use App\Errors\UserInputErrors;

/**
 * Subsystem, for checking whether the name of additional service meets the criteria,
 * according to the application requirements.
 */
class AdditionalServiceNameValidationService
{
    private function validateLength(string $name, UserInputErrors $errors)
    {
        if (strlen($name) === 0)
        {
            $errMessage = __('validation.required', ['attribute' => 'name']);
            $errors->add('name', $errMessage);
        }
    }

    /**
     * Checks if the name of additional service meets the necessary criteria
     *
     * @param string $name
     * Additional service's name
     * @param UserInputErrors $errors
     * Data structure, where discovered errors will be stored.
     */
    public function validate(string $name, UserInputErrors $errors) : void
    {
        $this->validateLength($name, $errors);
    }
}
