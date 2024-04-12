<?php

namespace App\Services\Admin\BaseModels\UserInputValidation;

use App\Errors\UserInputErrors;

/**
 * Subsystem, for checking whether the description of base model meets the criteria,
 * according to the application requirements.
 */
class BaseModelDescriptionValidationService
{
    private function validateLength(string $description, string $inputName, UserInputErrors $errors)
    {
        if (strlen($description) === 0)
        {
            $errMessage = __('validation.required', ['attribute' => 'description']);
            $errors->add($inputName, $errMessage);
        }
    }

    /**
     * Checks if the description of base model meets the necessary criteria
     *
     * @param string $description Base model's description
     * @param string $inputName
     * The name of the input to which validation errors will be added.
     * @param UserInputErrors $errors
     * Data structure, where discovered errors will be stored.
     */
    public function validate(string $description, string $inputName, UserInputErrors $errors) : void
    {
        $this->validateLength($description, $inputName, $errors);
    }
}
