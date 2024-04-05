<?php

namespace App\Services\Admin\AdditionalServices;
use App\Errors\UserInputErrors;
use App\ViewModels\Admin\AdditionalService\AdditionalServiceCreationViewModel;

/**
 * Subsystem for storing information about new additional service.
 */
class AdditionalServicesCreationService
{
    /**
     * Tries to create a new additional service from user's input.
     *
     * @param AdditionalServiceCreationViewModel $additionalService
     * User's input about new additional service
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function add(AdditionalServiceCreationViewModel $additionalService,
                        UserInputErrors $errors) : void
    {
        // ...
    }
}
