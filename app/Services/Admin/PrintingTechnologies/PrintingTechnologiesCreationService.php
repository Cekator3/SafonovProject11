<?php

namespace App\Services\Admin\PrintingTechnologies;

use App\Errors\UserInputErrors;
use App\Repositories\PrintingTechnologyRepository;
use App\Errors\Admin\PrintingTechnology\PrintingTechnologyCreationErrors;
use App\ViewModels\Admin\PrintingTechnology\PrintingTechnologyCreationViewModel;
use App\Services\Admin\PrintingTechnologies\UserInputValidation\PrintingTechnologyNameValidationService;
use App\Services\Admin\PrintingTechnologies\UserInputValidation\PrintingTechnologyDescriptionValidationService;

/**
 * Subsystem for storing information about new printing technology.
 */
class PrintingTechnologiesCreationService
{
    private function validateUserInput(PrintingTechnologyCreationViewModel $printingTechnology,
                                       UserInputErrors $errors)
    {
        $nameValidator = new PrintingTechnologyNameValidationService();
        $descriptionValidator = new PrintingTechnologyDescriptionValidationService();

        $nameValidator->validate($printingTechnology->name, $errors);
        $descriptionValidator->validate($printingTechnology->description, $errors);
    }

    private function isExists(PrintingTechnologyCreationViewModel $printingTechnology) : bool
    {
        $printingTechnologies = new PrintingTechnologyRepository();
        return $printingTechnologies->isExist($printingTechnology->name);
    }

    private function storeInformation(PrintingTechnologyCreationViewModel $printingTechnology,
                                      UserInputErrors $errors) : void
    {
        $creationErrors = new PrintingTechnologyCreationErrors();
        $printingTechnologies = new PrintingTechnologyRepository();

        $printingTechnologies->add($printingTechnology, $creationErrors);

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
     * @param PrintingTechnologyCreationViewModel $printingTechnology
     * User's input about new printing technology
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function add(PrintingTechnologyCreationViewModel $printingTechnology,
                        UserInputErrors $errors) : void
    {
        // 1. validate user's input
        $this->validateUserInput($printingTechnology, $errors);

        if ($errors->hasAny())
            return;

        // 2. check if additional service already exists
        if ($this->isExists($printingTechnology))
        {
            $errMessage = __('validation.unique', ['attribute' => 'name']);
            $errors->add('name', $errMessage);
            return;
        }

        // 3. store additional service information
        $this->storeInformation($printingTechnology, $errors);
    }
}
