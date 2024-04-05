<?php

namespace App\Services\Admin\AdditionalServices;

use App\Errors\UserInputErrors;

/**
 * Subsystem for deleting stored information on additional service.
 */
class AdditionalServicesDeletionService
{
    /**
     * Tries to delete the additional service.
     *
     * @param int $additionalServiceId
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function remove(int $additionalServiceId, UserInputErrors $errors) : void
    {
        // ...
    }
}
