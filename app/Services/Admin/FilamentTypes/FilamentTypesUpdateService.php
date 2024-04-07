<?php

namespace App\Services\Admin\FilamentTypes;

use App\Errors\UserInputErrors;
use App\Repositories\Admin\FilamentTypeRepository;
use App\Errors\Admin\FilamentType\FilamentTypeUpdateErrors;
use App\ViewModels\Admin\FilamentType\FilamentTypeUpdateViewModel;
use App\Services\Admin\FilamentTypes\UserInputValidation\FilamentTypeNameValidationService;
use App\Services\Admin\FilamentTypes\UserInputValidation\FilamentTypeHardnessValidationService;
use App\Services\Admin\FilamentTypes\UserInputValidation\FilamentTypeStrengthValidationService;
use App\Services\Admin\FilamentTypes\UserInputValidation\FilamentTypeDurabilityValidationService;
use App\Services\Admin\FilamentTypes\UserInputValidation\FilamentTypeDescriptionValidationService;
use App\Services\Admin\FilamentTypes\UserInputValidation\FilamentTypeWorkTemperatureValidationService;
use App\Services\Admin\FilamentTypes\UserInputValidation\FilamentTypeImpactResistanceValidationService;

/**
 * Subsystem for updating stored information on filament type.
 */
class FilamentTypesUpdateService
{
    private function validateUserInput(FilamentTypeUpdateViewModel $filamentType,
                                       UserInputErrors $errors)
    {
        $nameValidator = new FilamentTypeNameValidationService();
        $descriptionValidator = new FilamentTypeDescriptionValidationService();
        $strengthValidator = new FilamentTypeStrengthValidationService();
        $hardnessValidator = new FilamentTypeHardnessValidationService();
        $impactResistanceValidator = new FilamentTypeImpactResistanceValidationService();
        $durabilityValidator = new FilamentTypeDurabilityValidationService();
        $workTemperatureValidator = new FilamentTypeWorkTemperatureValidationService();

        $nameValidator->validate($filamentType->name, $errors);
        $descriptionValidator->validate($filamentType->description, $errors);
        $strengthValidator->validate($filamentType->strength, $errors);
        $hardnessValidator->validate($filamentType->hardness, $errors);
        $impactResistanceValidator->validate($filamentType->impactResistance, $errors);
        $durabilityValidator->validate($filamentType->durability, $errors);
        $workTemperatureValidator->validate($filamentType->minWorkTemperature, $filamentType->maxWorkTemperature, $errors);
    }

    private function updateInformation(FilamentTypeUpdateViewModel $filamentType,
                                       UserInputErrors $errors) : void
    {
        $updateErrors = new FilamentTypeUpdateErrors();
        $filamentTypes = new FilamentTypeRepository();

        $filamentTypes->update($filamentType, $updateErrors);

        if ($updateErrors->hasAny())
        {
            if ($updateErrors->isAlreadyExist())
            {
                $errMessage = __('validation.unique', ['attribute' => 'name']);
                $errors->add('name', $errMessage);
            }
        }
    }

    /**
     * Tries to update a filament type using user's input.
     *
     * @param FilamentTypeUpdateViewModel $filamentType User's input
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function update(FilamentTypeUpdateViewModel $filamentType,
                           UserInputErrors $errors) : void
    {
        // 1. validate user's input
        $this->validateUserInput($filamentType, $errors);

        if ($errors->hasAny())
            return;

        // 2. update filament type information
        $this->updateInformation($filamentType, $errors);
    }
}
