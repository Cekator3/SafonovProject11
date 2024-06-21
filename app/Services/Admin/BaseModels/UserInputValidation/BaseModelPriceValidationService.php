<?php

namespace App\Services\Admin\BaseModels\UserInputValidation;

use App\Errors\UserInputErrors;

/**
 * Subsystem, for checking whether the printing price of base model meets the criteria,
 * according to the application requirements.
 */
class BaseModelPriceValidationService
{
    /**
     * Checks if the printing price of base model meets the necessary criteria
     *
     * @param float $price Base model's printing price
     * @param string $inputName
     * The name of the input to which validation errors will be added.
     * @param UserInputErrors $errors
     * Data structure, where discovered errors will be stored.
     */
    public function validate(float $price, string $inputName, UserInputErrors $errors) : void
    {
        if ($price < 0)
        {
            $errMessage = __('admin/base_model_validation.price');
            $errors->add($inputName, $errMessage);
        }
    }
}
