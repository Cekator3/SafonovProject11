<?php

namespace App\Services\Admin\FilamentTypes;
use App\DTOs\Admin\FilamentTypes\FilamentTypeDTO;
use App\Repositories\Admin\FilamentTypeRepository;
use App\DTOs\Admin\FilamentTypes\FilamentTypeItemListDTO;

/**
 * Subsystem for getting stored information on filament type.
 */
class FilamentTypesGetterService
{
    /**
     * Returns all filament types.
     * @return FilamentTypeItemListDTO[]
     */
    public function getAll() : array
    {
        $printingTechnologies = new FilamentTypeRepository();
        return $printingTechnologies->getAll();
    }

    /**
     * Returns filament type.
     */
    public function get(int $printingTechnologyId) : FilamentTypeDTO|null
    {
        $printingTechnologies = new FilamentTypeRepository();
        return $printingTechnologies->get($printingTechnologyId);
    }

    /**
     * Finds all the relevant filament types
     * @return FilamentTypeItemListDTO[]
     */
    public function find(string $name) : array
    {
        $printingTechnologies = new FilamentTypeRepository();
        return $printingTechnologies->find($name);
    }
}
