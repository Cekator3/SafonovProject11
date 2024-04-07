<?php

namespace App\Services\Admin\PrintingTechnologies;

use App\Repositories\Admin\PrintingTechnologyRepository;

/**
 * Subsystem for deleting stored information on printing technology.
 */
class PrintingTechnologiesDeletionService
{
    /**
     * Tries to delete the printing technology.
     */
    public function remove(int $printingTechnologyId) : void
    {
        $printingTechnologies = new PrintingTechnologyRepository();
        $printingTechnologies->remove($printingTechnologyId);
    }
}
