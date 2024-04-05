<?php

namespace App\Services\Admin\AdditionalServices\UserInputValidation;
use App\Errors\UserInputErrors;

/**
 * Subsystem, for checking whether the name of additional service meets the criteria,
 * according to the application requirements.
 */
class AdditionalServiceDescriptionValidationService
{
    private function validateLength(string $description, UserInputErrors $errors)
    {
        // ...
    }

    /**
     * Checks if the description of additional service meets the necessary criteria
     *
     * @param string $description Additional service's description
     * @param UserInputErrors $errors
     * Data structure, where discovered errors will be stored.
     */
    public function validate(string $description, UserInputErrors $errors) : void
    {
        $this->validateLength($description, $errors);
    }
}
