<?php

namespace App\Services\Admin\FilamentTypes\UserInputValidation;

use App\Errors\UserInputErrors;

/**
 * Subsystem, for checking whether the description of filament type meets the criteria,
 * according to the application requirements.
 */
class FilamentTypeDescriptionValidationService
{
    private function validateLength(string $description, UserInputErrors $errors)
    {
        if (strlen($description) === 0)
        {
            $errMessage = __('validation.required', ['attribute' => 'description']);
            $errors->add('description', $errMessage);
        }
    }

    /**
     * Checks if the description of filament type meets the necessary criteria
     *
     * @param string $description Filament type's description
     * @param UserInputErrors $errors
     * Data structure, where discovered errors will be stored.
     */
    public function validate(string $description, UserInputErrors $errors) : void
    {
        $this->validateLength($description, $errors);
    }
}
