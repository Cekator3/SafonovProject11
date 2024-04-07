<?php

namespace App\Services\Admin\FilamentTypes\UserInputValidation;

use App\Errors\UserInputErrors;

/**
 * Subsystem, for checking whether the strength rate of filament type meets the criteria,
 * according to the application requirements.
 */
class FilamentTypeStrengthValidationService
{
    private const int MIN_RATE = 0;
    private const int MAX_RATE = 0;

    /**
     * Checks if the strength rate of filament type meets the necessary criteria
     *
     * @param int $strength
     * Filament type's strength rate
     * @param UserInputErrors $errors
     * Data structure, where discovered errors will be stored.
     */
    public function validate(int $strength, UserInputErrors $errors) : void
    {
        if (($strength < static::MIN_RATE) || ($strength > static::MAX_RATE))
        {
            $errMessage = __('admin.filament_type_validation.strength',
                             ['left' => static::MIN_RATE, 'right' => static::MAX_RATE]);
            $errors->add('strength', $errMessage);
        }
    }
}
