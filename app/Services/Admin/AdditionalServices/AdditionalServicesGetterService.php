<?php

namespace App\Services\Admin\AdditionalServices;
use App\DTOs\Admin\AdditionalServiceDTO;

/**
 * Subsystem for getting stored information on additional service.
 */
class AdditionalServicesGetterService
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
    public function get(int $additionalServiceId) : AdditionalServiceDTO|null
    {
        // ...
    }

    /**
     * Finds all the relevant additional services
     * @return AdditionalServiceDTO[]
     */
    public function find(string $additionalServiceName) : array
    {

    }
}
