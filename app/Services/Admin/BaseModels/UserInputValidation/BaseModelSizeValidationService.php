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
    private function validateSizeMultiplier(float $multiplier, UserInputErrors $errors) : void
    {
        if ($multiplier <= 0)
        {
            $errMessage = __('admin/base_model_validation.size');
            $errors->add('model-sizes[][multiplier]', $errMessage);
        }
    }

    private function validateLength(int $length, UserInputErrors $errors) : void
    {
        if ($length <= 0)
        {
            $errMessage = __('admin/base_model_validation.size');
            $errors->add('model-sizes[][length]', $errMessage);
        }
    }

    private function validateWidth(int $width, UserInputErrors $errors) : void
    {
        if ($width <= 0)
        {
            $errMessage = __('admin/base_model_validation.width');
            $errors->add('model-sizes[][width]', $errMessage);
        }
    }

    private function validateHeight(int $height, UserInputErrors $errors) : void
    {
        if ($height <= 0)
        {
            $errMessage = __('admin/base_model_validation.height');
            $errors->add('model-sizes[][height]', $errMessage);
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
        $this->validateSizeMultiplier($size->multiplier, $errors);
        $this->validateLength($size->length, $errors);
        $this->validateWidth($size->width, $errors);
        $this->validateHeight($size->height, $errors);
    }
}
