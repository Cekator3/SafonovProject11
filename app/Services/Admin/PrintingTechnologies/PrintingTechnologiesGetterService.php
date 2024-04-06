<?php

namespace App\Services\Admin\PrintingTechnologies;

use App\DTOs\Admin\PrintingTechnologies\PrintingTechnologyDTO;
use App\Repositories\PrintingTechnologyRepository;

/**
 * Subsystem for getting stored information on printing technology.
 */
class PrintingTechnologiesGetterService
{
    /**
     * Returns all printing technologies.
     * @return PrintingTechnologyDTO[]
     */
    public function getAll() : array
    {
        $printingTechnologies = new PrintingTechnologyRepository();
        return $printingTechnologies->getAll();
    }

    /**
     * Returns printing technology.
     */
    public function get(int $printingTechnologyId) : PrintingTechnologyDTO|null
    {
        $printingTechnologies = new PrintingTechnologyRepository();
        return $printingTechnologies->get($printingTechnologyId);
    }

    /**
     * Finds all the relevant printing technologies
     * @return PrintingTechnologyDTO[]
     */
    public function find(string $name) : array
    {
        $printingTechnologies = new PrintingTechnologyRepository();
        return $printingTechnologies->find($name);
    }
}
