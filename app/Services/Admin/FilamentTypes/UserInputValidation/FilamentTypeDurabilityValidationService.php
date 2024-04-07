<?php

namespace App\Services\Admin\FilamentTypes\UserInputValidation;

use App\Errors\UserInputErrors;

/**
 * Subsystem, for checking whether the durability rate of filament type meets the criteria,
 * according to the application requirements.
 */
class FilamentTypeDurabilityValidationService
{
    private const int MIN_RATE = 0;
    private const int MAX_RATE = 5;

    /**
     * Checks if the durability rate of filament type meets the necessary criteria
     *
     * @param int $durability
     * Filament type's durability rate
     * @param UserInputErrors $errors
     * Data structure, where discovered errors will be stored.
     */
    public function validate(int $durability, UserInputErrors $errors) : void
    {
        if (($durability < static::MIN_RATE) || ($durability > static::MAX_RATE))
        {
            $errMessage = __('admin/filament_type_validation.durability',
                             ['left' => static::MIN_RATE, 'right' => static::MAX_RATE]);
            $errors->add('durability', $errMessage);
        }
    }
}
