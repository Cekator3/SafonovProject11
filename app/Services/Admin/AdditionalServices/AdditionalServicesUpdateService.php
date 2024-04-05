<?php

namespace App\Services\Admin\AdditionalServices;
use App\Errors\UserInputErrors;
use App\ViewModels\Admin\AdditionalService\AdditionalServiceUpdateViewModel;

/**
 * Subsystem for updating stored information on additional service.
 */
class AdditionalServicesUpdateService
{
    /**
     * Tries to update a additional service using user's input.
     *
     * @param AdditionalServiceUpdateViewModel $additionalService User's input
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function update(AdditionalServiceUpdateViewModel $additionalService,
                           UserInputErrors $errors) : void
    {
        // ...
    }
}
