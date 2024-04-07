<?php

namespace App\Services\Admin\FilamentTypes;

use App\Errors\Admin\FilamentType\FilamentTypeCreationErrors;
use App\Errors\UserInputErrors;
use App\Repositories\Admin\FilamentTypeRepository;
use App\Services\Admin\FilamentTypes\UserInputValidation\FilamentTypeDescriptionValidationService;
use App\Services\Admin\FilamentTypes\UserInputValidation\FilamentTypeDurabilityValidationService;
use App\Services\Admin\FilamentTypes\UserInputValidation\FilamentTypeHardnessValidationService;
use App\Services\Admin\FilamentTypes\UserInputValidation\FilamentTypeImpactResistanceValidationService;
use App\Services\Admin\FilamentTypes\UserInputValidation\FilamentTypeNameValidationService;
use App\Services\Admin\FilamentTypes\UserInputValidation\FilamentTypeStrengthValidationService;
use App\Services\Admin\FilamentTypes\UserInputValidation\FilamentTypeWorkTemperatureValidationService;
use App\ViewModels\Admin\FilamentType\FilamentTypeCreationViewModel;

/**
 * Subsystem for storing information about new printing technology.
 */
class FilamentTypesCreationService
{
    private function validateUserInput(FilamentTypeCreationViewModel $filamentType,
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

    private function isExists(FilamentTypeCreationViewModel $filamentType) : bool
    {
        $filamentTypes = new FilamentTypeRepository();
        return $filamentTypes->isExist($filamentType->name);
    }

    private function storeInformation(FilamentTypeCreationViewModel $filamentType,
                                      UserInputErrors $errors) : void
    {
        $creationErrors = new FilamentTypeCreationErrors();
        $filamentTypes = new FilamentTypeRepository();

        $filamentTypes->add($filamentType, $creationErrors);

        if ($creationErrors->hasAny())
        {
            if ($creationErrors->isAlreadyExist())
            {
                $errMessage = __('validation.unique', ['attribute' => 'name']);
                $errors->add('name', $errMessage);
            }
        }
    }

    /**
     * Tries to create a new printing technology from user's input.
     *
     * @param FilamentTypeCreationViewModel $filamentType
     * User's input about new filament type
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function add(FilamentTypeCreationViewModel $filamentType,
                        UserInputErrors $errors) : void
    {
        // 1. validate user's input
        $this->validateUserInput($filamentType, $errors);

        if ($errors->hasAny())
            return;

        // 2. check if filament type already exists
        if ($this->isExists($filamentType))
        {
            $errMessage = __('validation.unique', ['attribute' => 'name']);
            $errors->add('name', $errMessage);
            return;
        }

        // 3. store filament type information
        $this->storeInformation($filamentType, $errors);
    }
}
