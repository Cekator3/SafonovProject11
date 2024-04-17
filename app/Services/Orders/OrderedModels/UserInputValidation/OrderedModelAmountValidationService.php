<?php

namespace App\Services\Orders\OrderedModels\UserInputValidation;

use App\Errors\UserInputErrors;

/**
 * Subsystem, for checking whether the amount of ordered models to print
 * meets the criteria, according to the application requirements.
 */
class OrderedModelAmountValidationService
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
     * Checks if the amount of ordered models to print meets the necessary criteria
     *
     * @param int $amount
     * amount of ordered models to print
     * @param string $inputName
     * The name of the input to which validation errors will be added.
     * @param UserInputErrors $errors
     * Data structure, where discovered errors will be stored.
     */
    public function validate(int $amount, string $inputName, UserInputErrors $errors) : void
    {
        if ($amount <= 0)
        {
            $errMessage = 'Количество должно быть положительным числом';
            $errors->add($inputName, $errMessage);
        }
    }
}
