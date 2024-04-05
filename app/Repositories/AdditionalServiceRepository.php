<?php

namespace App\Repositories;

use App\DTOs\Admin\AdditionalServiceDTO;
use App\Errors\Admin\AdditionalService\AdditionalServiceCreationErrors;
use App\ViewModels\Admin\AdditionalService\AdditionalServiceUpdateViewModel;
use App\ViewModels\Admin\AdditionalService\AdditionalServiceCreationViewModel;

/**
 * Subsystem for interaction with stored information on additional services
 */
class AdditionalServiceRepository
{
    /**
     * Returns all additional services.
     * @return AdditionalServiceDTO[]
     */
    public function getAll() : array
    {
        // ...
    }

    /**
     * Returns additional service.
     */
    public function get(int $id) : AdditionalServiceDTO|null
    {
        // ...
    }

    /**
     * Adds additional service.
     *
     * @param AdditionalServiceCreationViewModel $additionalService
     * New additional service's data.
     * @param AdditionalServiceCreationErrors $errors
     * An object for storing operation errors.
     */
    public function add(AdditionalServiceCreationViewModel $additionalService,
                        AdditionalServiceCreationErrors $errors) : void
    {

    }

    /**
     * Updates additional service.
     *
     * @param AdditionalServiceUpdateViewModel $additionalService New additional service's data.
     * @param AdditionalServiceUpdateErrors $errors
     * An object for storing operation errors.
     */
    public function update(AdditionalServiceUpdateViewModel $additionalService,
                           AdditionalServiceUpdateErrors $errors) : void
    {
        // ...
    }

    /**
     * Deletes additional service.
     *
     * @param int $id Identifier of the additional service
     * @param bool &$isSuccess Will be set to true if operation was successful
     */
    public function remove(int $id, bool &$isSuccess) : void
    {
        // ...
    }
}
