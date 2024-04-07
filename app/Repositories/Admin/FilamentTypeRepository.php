<?php

namespace App\Repositories\Admin;

use stdClass;
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
    private const string TABLE_NAME = 'filament_types';

    /**
     * Returns all filament types
     * @return FilamentTypeItemListDTO[]
     */
    public function getAll() : array
    {
        // ...
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
