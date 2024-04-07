<?php

namespace App\Services\Admin\FilamentTypes\UserInputValidation;

use App\Errors\UserInputErrors;

/**
 * Subsystem, for checking whether the impact resistance rate of filament type meets the criteria,
 * according to the application requirements.
 */
class FilamentTypeImpactResistanceValidationService
{
    private const int MIN_RATE = 0;
    private const int MAX_RATE = 5;

    /**
     * Checks if the impact resistance rate of filament type meets the necessary criteria
     *
     * @param int $impactResistance
     * Filament type's impact resistance rate
     * @param UserInputErrors $errors
     * Data structure, where discovered errors will be stored.
     */
    public function validate(int $impactResistance, UserInputErrors $errors) : void
    {
        if (($impactResistance < static::MIN_RATE) || ($impactResistance > static::MAX_RATE))
        {
            $errMessage = __('admin/filament_type_validation.impact_resistance',
                             ['left' => static::MIN_RATE, 'right' => static::MAX_RATE]);
            $errors->add('impact_resistance', $errMessage);
        }
    }
}
