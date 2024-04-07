<?php

namespace App\Services\Admin\FilamentTypes\UserInputValidation;

use App\Errors\UserInputErrors;

/**
 * Subsystem, for checking whether the work temperature of filament type meets the criteria,
 * according to the application requirements.
 */
class FilamentTypeWorkTemperatureValidationService
{
    /**
     * Checks if the work temperature of filament type meets the necessary criteria
     *
     * @param int $minWorkTemperature
     * Filament type's minimal work temperature
     * @param int $maxWorkTemperature
     * Filament type's minimal work temperature
     * @param UserInputErrors $errors
     * Data structure, where discovered errors will be stored.
     */
    public function validate(int $minWorkTemperature, int $maxWorkTemperature, UserInputErrors $errors) : void
    {
        if ($minWorkTemperature > $maxWorkTemperature)
        {
            $errMessage = __('admin/filament_type_validation.work_temperature_range');
            $errors->add('min_work_temperature', $errMessage);
        }
        if (($minWorkTemperature < -32768) || ($minWorkTemperature > 32768))
        {
            $errMessage = __('admin/filament_type_validation.min_work_temperature',
                            ['left' => -32768, 'right' => 32768]);
            $errors->add('min_work_temperature', $errMessage);
        }
        if (($maxWorkTemperature > 32768) || ($maxWorkTemperature < -32768))
        {
            $errMessage = __('admin/filament_type_validation.max_work_temperature',
                            ['left' => -32768, 'right' => 32768]);
            $errors->add('max_work_temperature', $errMessage);
        }
    }
}
