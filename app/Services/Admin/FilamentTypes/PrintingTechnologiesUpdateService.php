<?php

namespace App\Services\Admin\PrintingTechnologies;

use App\Errors\UserInputErrors;
use App\Repositories\Admin\PrintingTechnologyRepository;
use App\Errors\Admin\PrintingTechnology\PrintingTechnologyUpdateErrors;
use App\ViewModels\Admin\PrintingTechnology\PrintingTechnologyUpdateViewModel;
use App\Services\Admin\PrintingTechnologies\UserInputValidation\PrintingTechnologyNameValidationService;
use App\Services\Admin\AdditionalServices\UserInputValidation\AdditionalServiceDescriptionValidationService;

/**
 * Subsystem for updating stored information on printing technology.
 */
class PrintingTechnologiesUpdateService
{
    private function validateUserInput(PrintingTechnologyUpdateViewModel $printingTechnology,
                                       UserInputErrors $errors)
    {
        $nameValidator = new PrintingTechnologyNameValidationService();
        $descriptionValidator = new AdditionalServiceDescriptionValidationService();

        $nameValidator->validate($printingTechnology->name, $errors);
        $descriptionValidator->validate($printingTechnology->description, $errors);
    }

    private function updateInformation(PrintingTechnologyUpdateViewModel $printingTechnology,
                                       UserInputErrors $errors) : void
    {
        $updateErrors = new PrintingTechnologyUpdateErrors();
        $printingTechnologies = new PrintingTechnologyRepository();

        $printingTechnologies->update($printingTechnology, $updateErrors);

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
     * Tries to update a printing technology using user's input.
     *
     * @param PrintingTechnologyUpdateViewModel $printingTechnology User's input
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function update(PrintingTechnologyUpdateViewModel $printingTechnology,
                           UserInputErrors $errors) : void
    {
        // 1. validate user's input
        $this->validateUserInput($printingTechnology, $errors);

        if ($errors->hasAny())
            return;

        // 2. update additional service information
        $this->updateInformation($printingTechnology, $errors);
    }
}
