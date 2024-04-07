<?php

namespace App\Services\Admin\FilamentTypes;

use App\Repositories\Admin\FilamentTypeRepository;

/**
 * Subsystem for deleting stored information on filament type.
 */
class FilamentTypesDeletionService
{
    /**
     * Tries to delete the filament type.
     */
    public function remove(int $filamentTypeId) : void
    {
        $filamentTypes = new FilamentTypeRepository();
        $filamentTypes->remove($filamentTypeId);
    }
}
