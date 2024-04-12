<?php

namespace App\Services\Admin\BaseModels\UserInputValidation;

use App\Errors\UserInputErrors;

/**
 * Subsystem, for checking whether the name of base model meets the criteria,
 * according to the application requirements.
 */
class BaseModelNameValidationService
{
    private function validateLength(string $name, string $inputName, UserInputErrors $errors)
    {
        if (strlen($name) === 0)
        {
            $errMessage = __('validation.required', ['attribute' => 'name']);
            $errors->add($inputName, $errMessage);
        }
    }

    /**
     * Checks if the name of base model meets the necessary criteria
     *
     * @param string $name Base model's name
     * @param string $inputName
     * The name of the input to which validation errors will be added.
     * @param UserInputErrors $errors
     * Data structure, where discovered errors will be stored.
     */
    public function validate(string $name, string $inputName, UserInputErrors $errors) : void
    {
        $this->validateLength($name, $inputName, $errors);
    }
}
