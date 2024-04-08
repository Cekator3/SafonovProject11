<?php

namespace App\Repositories\Admin;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\DTOs\Admin\FilamentTypes\FilamentTypeDTO;
use App\DTOs\Admin\FilamentTypes\FilamentTypeItemListDTO;
use App\Errors\Admin\FilamentType\FilamentTypeUpdateErrors;
use Illuminate\Database\UniqueConstraintViolationException;
use App\DTOs\Admin\FilamentTypes\FilamentTypeCharacteristics;
use App\Errors\Admin\FilamentType\FilamentTypeCreationErrors;
use App\ViewModels\Admin\FilamentType\FilamentTypeUpdateViewModel;
use App\ViewModels\Admin\FilamentType\FilamentTypeCreationViewModel;
use App\DTOs\Admin\PrintingTechnologies\PrintingTechnologyNameOnlyDTO;

/**
 * Subsystem for interaction with stored information on filament types
 */
class FilamentTypeRepository
{
    private function getUniqueEntries(Collection $collectedEntries, string $key) : array
    {
        return $collectedEntries->pluck($key)->unique()->values()->filter()->all();
    }

    private function getFilamentTypesNames(array $ids) : Collection
    {
        return DB::table('filament_types')
                 ->whereIn('id', $ids)
                 ->select('id as filament_type_id', 'name AS filament_type_name')
                 ->get()
                 ->keyBy('filament_type_id');
    }

    private function getPrintingTechnologiesNames(array $ids) : Collection
    {
        return DB::table('printing_technologies')
                 ->whereIn('id', $ids)
                 ->select('id as printing_technology_id', 'name AS printing_technology_name')
                 ->get()
                 ->keyBy('printing_technology_id');
    }

    /**
     * Returns all filament types
     * @return FilamentTypeItemListDTO[]
     */
    public function getAll() : array
    {
        // 1. Get identifiers of all filament types and associated
        //    with them printing technologies (only identifiers)
        $entries = DB::table('filament_types AS ft')
                     ->join('printing_technologies_of_filament_type AS ptft', 'ptft.filament_type_id', '=', 'ft.id', 'left')
                     ->join('printing_technologies AS pt', 'ptft.printing_technology_id', '=', 'pt.id', 'left')
                     ->select(['ft.id AS filament_type_id', 'pt.id AS printing_technology_id'])
                     ->get();

        // 2. Get unique id values
        $collectedEntries = collect($entries);
        $filamentTypesIds = $this->getUniqueEntries($collectedEntries, 'filament_type_id');
        $printingTechnologiesIds = $this->getUniqueEntries($collectedEntries, 'printing_technology_id');

        // 3. Get names
        $filamentTypesNames = $this->getFilamentTypesNames($filamentTypesIds);
        $printingTechnologiesNames = $this->getPrintingTechnologiesNames($printingTechnologiesIds);

        // 4. Union names and identifiers
        $filamentTypes = [];
        $groups = $entries->groupBy('filament_type_id');
        foreach ($groups as $group)
        {
            $printingTechnologies = [];
            foreach ($group as $printingTechnology)
            {
                $id = $printingTechnology->printing_technology_id;
                // Breaks if group empty
                if ($id === null)
                    break;
                $name = $printingTechnologiesNames[$id]->printing_technology_name;
                $printingTechnologies []= new PrintingTechnologyNameOnlyDTO($id, $name);
            }
            $id = $group[0]->filament_type_id;
            $name = $filamentTypesNames[$id]->filament_type_name;
            $filamentTypes []= new FilamentTypeItemListDTO($id, $name, $printingTechnologies);
        }
        return $filamentTypes;
    }

    /**
     * Finds all the relevant filament types.
     * @return FilamentTypeItemListDTO[]
     */
    public function find(string $name) : array
    {
        // 1. Get identifiers of all filament types and associated
        //    with them printing technologies (only identifiers)
        $entries = DB::table('filament_types AS ft')
                     ->whereFullText('ft.name', $name)
                     ->join('printing_technologies_of_filament_type AS ptft', 'ptft.filament_type_id', '=', 'ft.id', 'left')
                     ->join('printing_technologies AS pt', 'ptft.printing_technology_id', '=', 'pt.id', 'left')
                     ->select(['ft.id AS filament_type_id', 'pt.id AS printing_technology_id'])
                     ->get();

        // 2. Get unique id values
        $collectedEntries = collect($entries);
        $filamentTypesIds = $this->getUniqueEntries($collectedEntries, 'filament_type_id');
        $printingTechnologiesIds = $this->getUniqueEntries($collectedEntries, 'printing_technology_id');

        // 3. Get names
        $filamentTypesNames = $this->getFilamentTypesNames($filamentTypesIds);
        $printingTechnologiesNames = $this->getPrintingTechnologiesNames($printingTechnologiesIds);

        // 4. Union names and identifiers
        $filamentTypes = [];
        $groups = $entries->groupBy('filament_type_id');
        foreach ($groups as $group)
        {
            $printingTechnologies = [];
            foreach ($group as $printingTechnology)
            {
                $id = $printingTechnology->printing_technology_id;
                // Breaks if group empty
                if ($id === null)
                    break;
                $name = $printingTechnologiesNames[$id]->printing_technology_name;
                $printingTechnologies []= new PrintingTechnologyNameOnlyDTO($id, $name);
            }
            $id = $group[0]->filament_type_id;
            $name = $filamentTypesNames[$id]->filament_type_name;
            $filamentTypes []= new FilamentTypeItemListDTO($id, $name, $printingTechnologies);
        }
        return $filamentTypes;
    }

    /**
     * Returns filament type.
     */
    public function get(int $id) : FilamentTypeDTO|null
    {
        $filamentTypeEntry = DB::table('filament_types')->find($id);
        if ($filamentTypeEntry === null)
            return null;

        // Gets printing technology list of filament type
        $printingTechnologiesEntries = DB::table('printing_technologies_of_filament_type AS ptft')
                     ->where('filament_type_id', '=', $id)
                     ->join('printing_technologies AS pt', 'ptft.printing_technology_id', '=', 'pt.id')
                     ->select(['pt.id AS printing_technology_id', 'pt.name AS printing_technology_name'])
                     ->get();

        $printingTechnologies = [];
        foreach ($printingTechnologiesEntries as $entry)
        {
            $id = $entry->printing_technology_id;
            $name = $entry->printing_technology_name;
            $printingTechnologies []= new PrintingTechnologyNameOnlyDTO($id, $name);
        }

        $filamentTypeCharacteristics =
            new FilamentTypeCharacteristics($filamentTypeEntry->strength,
                                            $filamentTypeEntry->hardness,
                                            $filamentTypeEntry->impact_resistance,
                                            $filamentTypeEntry->durability,
                                            $filamentTypeEntry->min_work_temperature,
                                            $filamentTypeEntry->max_work_temperature,
                                            $filamentTypeEntry->food_contact_allowed);
        return new FilamentTypeDTO($filamentTypeEntry->id,
                                   $filamentTypeEntry->name,
                                   $filamentTypeEntry->description,
                                   $filamentTypeCharacteristics,
                                   $printingTechnologies);
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
            $filamentTypeId = DB::table('filament_types')->insertGetId([
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

            $result = [];
            foreach ($filamentType->printingTechnologiesIds as $printingTechnologyId)
            {
                $result []= [
                    'filament_type_id' => $filamentTypeId,
                    'printing_technology_id' => $printingTechnologyId
                ];
            }

            DB::table('printing_technologies_of_filament_type')->insert($result);
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
        try
        {
            DB::table('filament_types')->where('id', $filamentType->id)
                                       ->update([
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

            $result = [];
            foreach ($filamentType->printingTechnologiesIds as $printingTechnologyId)
            {
                $result []= [
                    'filament_type_id' => $filamentType->id,
                    'printing_technology_id' => $printingTechnologyId
                ];
            }

            DB::transaction(function () use ($result, $filamentType)
            {
                DB::table('printing_technologies_of_filament_type')
                  ->where('filament_type_id', '=', $filamentType->id)
                  ->delete();
                DB::table('printing_technologies_of_filament_type')->insert($result);
            });
        }
        catch (UniqueConstraintViolationException $e)
        {
            $errors->add(FilamentTypeCreationErrors::ERROR_FILAMENT_TYPE_ALREADY_EXIST);
        }
    }

    /**
     * Deletes filament type.
     *
     * @param int $id Identifier of the filament type
     */
    public function remove(int $id) : void
    {
        DB::table('filament_types')->delete($id);
    }
}
