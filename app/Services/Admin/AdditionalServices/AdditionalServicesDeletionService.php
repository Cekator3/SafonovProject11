<?php

namespace App\Services\Admin\AdditionalServices;

use App\Repositories\Admin\AdditionalServiceRepository;

/**
 * Subsystem for deleting stored information on additional service.
 */
class AdditionalServicesDeletionService
{
    /**
     * Deletes the additional service.
     */
    public function remove(int $additionalServiceId) : void
    {
        $additionalServices = new AdditionalServiceRepository();
        $additionalServices->remove($additionalServiceId);
    }
}
