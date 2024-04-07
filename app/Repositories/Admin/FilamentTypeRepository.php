<?php

namespace App\Repositories\Admin;

use stdClass;
use Illuminate\Support\Facades\DB;
use App\DTOs\Admin\FilamentTypes\FilamentTypeDTO;
use App\DTOs\Admin\FilamentTypes\FilamentTypeItemListDTO;
use App\Errors\Admin\FilamentType\FilamentTypeUpdateErrors;
use Illuminate\Database\UniqueConstraintViolationException;
use App\Errors\Admin\FilamentType\FilamentTypeCreationErrors;
use App\ViewModels\Admin\FilamentType\FilamentTypeUpdateViewModel;
use App\ViewModels\Admin\FilamentType\FilamentTypeCreationViewModel;
use App\DTOs\Admin\PrintingTechnologies\PrintingTechnologyNameOnlyDTO;

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
        //    with them printing technologies (only identifiers)
        $entries = DB::table('filament_types', 'ft')
                     ->join('printing_technologies_of_filament_type AS ptft', 'ptft.filament_type_id', '=', 'ft.id')
                     ->join('printing_technologies AS pt', 'ptft.printing_technology_id', '=', 'pt.id')
                     ->select(['ft.id AS filament_type_id', 'pt.id AS printing_technology_id'])
                     ->get();
        dump($entries);
        // 2. ???
        // 3. Get filament types names
        $entries = DB::table('filament_types', 'ft')
                     ->where('ft.id', '=', $entries)
                     ->select('ft.id as filament_type_id', 'ft.name AS filament_type_name')
                     ->get();
        // 4. Get printing technologies names
        $entries = DB::table('printing_technologies', 'pt')
                     ->where('pt.id', '=', $entries)
                     ->select('pt.id as printing_technology_id', 'pt.name AS printing_technology_name')
                     ->get();
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
        return DB::table('filament_types')
                 ->where('name', '=', $name)
                 ->exists();
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
        try
        {
            DB::table('filament_types')->insert([
                'name' => $filamentType->name,
                'description' => $filamentType->description,
                'strength' => $filamentType->strength,
                'hardness' => $filamentType->hardness,
                'impact_resistance' => $filamentType->impactResistance,
                'durability' => $filamentType->durability,
                'min_work_temperature' => $filamentType->minWorkTemperature,
                'max_work_temperature' => $filamentType->maxWorkTemperature,
                'food_contact_allowed' => $filamentType->food_contact_allowed
            ]);
        }
        catch (UniqueConstraintViolationException $e)
        {
            $errors->add(FilamentTypeCreationErrors::ERROR_FILAMENT_TYPE_ALREADY_EXIST);
        }
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
