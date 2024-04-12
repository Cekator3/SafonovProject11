<?php

namespace App\Services\Admin\BaseModels\UserInputValidation;

use App\Errors\UserInputErrors;
use App\ViewModels\Admin\BaseModel\BaseModelSize;

/**
 * Subsystem, for checking whether the sizes of base model meets the criteria,
 * according to the application requirements.
 */
class BaseModelSizeValidationService
{
    private function validateSizeMultiplier(float $multiplier, string $inputName, UserInputErrors $errors) : void
    {
        if ($multiplier <= 0)
        {
            $errMessage = __('admin/base_model_validation.size.multiplier');
            $errors->add($inputName, $errMessage);
        }
    }

    private function validateLength(int $length, string $inputName, UserInputErrors $errors) : void
    {
        if ($length <= 0)
        {
            $errMessage = __('admin/base_model_validation.size.length');
            $errors->add($inputName, $errMessage);
        }
    }

    private function validateWidth(int $width, string $inputName, UserInputErrors $errors) : void
    {
        if ($width <= 0)
        {
            $errMessage = __('admin/base_model_validation.size.width');
            $errors->add($inputName, $errMessage);
        }
    }

    private function validateHeight(int $height, string $inputName, UserInputErrors $errors) : void
    {
        if ($height <= 0)
        {
            $errMessage = __('admin/base_model_validation.size.height');
            $errors->add($inputName, $errMessage);
        }
    }

    /**
     * Checks if the sizes of base model meets the necessary criteria
     *
     * @param BaseModelSize $size Base model's size
     * @param UserInputErrors $errors
     * Data structure, where discovered errors will be stored.
     */
    public function validate(BaseModelSize $size, UserInputErrors $errors) : void
    {
        $this->validateSizeMultiplier($size->multiplier, $size->multiplierInputName, $errors);
        $this->validateLength($size->length, $size->lengthInputName, $errors);
        $this->validateWidth($size->width, $size->widthInputName, $errors);
        $this->validateHeight($size->height, $size->heightInputName, $errors);
    }
}
