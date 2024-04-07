<?php

namespace App\Repositories\Admin;

use App\DTOs\Admin\PrintingTechnologies\PrintingTechnologyNameOnlyDTO;
use stdClass;
use Illuminate\Support\Facades\DB;
use App\DTOs\Admin\FilamentTypes\FilamentTypeDTO;
use App\DTOs\Admin\FilamentTypes\FilamentTypeItemListDTO;
use App\Errors\Admin\FilamentType\FilamentTypeUpdateErrors;
use App\Errors\Admin\FilamentType\FilamentTypeCreationErrors;
use App\ViewModels\Admin\FilamentType\FilamentTypeUpdateViewModel;
use App\ViewModels\Admin\FilamentType\FilamentTypeCreationViewModel;

/**
 * Subsystem for interaction with stored information on filament types
 */
class FilamentTypeRepository
{
    /**
     * @param stdClass $entries
     */
    private function getPrintingTechnologies(array $entries) : PrintingTechnologyNameOnlyDTO
    {
        foreach ($entries as $entry)
        {
            $printingTechnologies = DB::table(static::PRINTING_TECHNOLOGIES_TABLE_NAME)
                                      ->get(['id', 'name']);
        }
    }

    /**
     * Returns all filament types
     * @return FilamentTypeItemListDTO[]
     */
    public function getAll() : array
    {
        // 1. Get identifiers of all filament types and associated
        //    with them printing technologies
        $entries = DB::table('filament_types', 'ft')
                     ->join('printing_technologies_of_filament_type AS ptft', 'ptft.filament_type_id', '=', 'ft.id')
                     ->join('printing_technologies AS pt', 'ptft.printing_technology_id', '=', 'pt.id')
                     ->select(['ft.id AS filament_type_id', 'pt.id AS printing_technology_id'])
                     ->get();
        dd($entries);
    }

    /**
     * Returns filament type.
     */
    public function get(int $id) : FilamentTypeDTO|null
    {
        // ...
    }

    /**
     * Finds all the relevant filament types.
     * @return FilamentTypeItemListDTO[]
     */
    public function find(string $name) : array
    {
        // ...
    }

    /**
     * Returns true if filament type exists.
     */
    public function isExist(string $name) : bool
    {
        // ...
    }

    /**
     * Adds filament type.
     *
     * @param FilamentTypeCreationViewModel $filamentType
     * New filament type's data.
     * @param FilamentTypeCreationErrors $errors
     * An object for storing operation errors.
     */
    public function add(FilamentTypeCreationViewModel $filamentType,
                        FilamentTypeCreationErrors $errors) : void
    {
        // ...
    }

    /**
     * Updates filament type.
     *
     * @param FilamentTypeUpdateViewModel $filamentType New filament type's data.
     * @param FilamentTypeUpdateErrors $errors
     * An object for storing operation errors.
     */
    public function update(FilamentTypeUpdateViewModel $filamentType,
                           FilamentTypeUpdateErrors $errors) : void
    {
        // ...
    }

    /**
     * Deletes filament type.
     *
     * @param int $id Identifier of the filament type
     */
    public function remove(int $id) : void
    {
        // ...
    }
}
