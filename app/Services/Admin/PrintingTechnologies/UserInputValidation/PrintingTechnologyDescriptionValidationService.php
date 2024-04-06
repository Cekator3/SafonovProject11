<?php

namespace App\Services\Admin\PrintingTechnologies\UserInputValidation;
use App\Errors\UserInputErrors;

/**
 * Subsystem, for checking whether the name of printing technology meets the criteria,
 * according to the application requirements.
 */
class PrintingTechnologyDescriptionValidationService
{
    private function validateLength(string $description, UserInputErrors $errors)
    {
        if (strlen($description) === 0)
        {
            $errMessage = __('validation.required', ['attribute' => 'name']);
            $errors->add('name', $errMessage);
        }
    }

    /**
     * Checks if the description of printing technology meets the necessary criteria
     *
     * @param string $description Printing technology's description
     * @param UserInputErrors $errors
     * Data structure, where discovered errors will be stored.
     */
    public function validate(string $description, UserInputErrors $errors) : void
    {
        $this->validateLength($description, $errors);
    }
}
