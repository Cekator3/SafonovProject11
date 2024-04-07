<?php

namespace App\Services\Admin\FilamentTypes\UserInputValidation;

use App\Errors\UserInputErrors;

/**
 * Subsystem, for checking whether the hardness rate of filament type meets the criteria,
 * according to the application requirements.
 */
class FilamentTypeHardnessValidationService
{
    private const int MIN_RATE = 0;
    private const int MAX_RATE = 0;

    /**
     * Checks if the hardness rate of filament type meets the necessary criteria
     *
     * @param int $hardness
     * Filament type's hardness rate
     * @param UserInputErrors $errors
     * Data structure, where discovered errors will be stored.
     */
    public function validate(int $hardness, UserInputErrors $errors) : void
    {
        if (($hardness < static::MIN_RATE) || ($hardness > static::MAX_RATE))
        {
            $errMessage = __('admin.filament_type_validation.hardness',
                             ['left' => static::MIN_RATE, 'right' => static::MAX_RATE]);
            $errors->add('hardness', $errMessage);
        }
    }
}
