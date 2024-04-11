<?php

namespace App\Repositories\Admin\BaseModels;

use App\DTOs\Admin\BaseModels\BaseModelDTO;
use App\DTOs\Admin\BaseModels\ModelItemListDTO;
use App\Errors\Admin\BaseModel\BaseModelUpdateErrors;
use App\Errors\Admin\BaseModel\BaseModelCreationErrors;
use App\ViewModels\Admin\BaseModel\BaseModelUpdateViewModel;
use App\ViewModels\Admin\BaseModel\BaseModelCreationViewModel;

/**
 * Subsystem for interaction with stored information on base models
 */
class BaseModelRepository
{
    /**
     * Returns all base models
     *
     * @return ModelItemListDTO[]
     */
    public function getAll() : array
    {
        // ...
    }

    /**
     * Returns base models.
     */
    public function get(int $id) : BaseModelDTO|null
    {
        // ...
    }

    /**
     * Finds all the relevant base models
     *
     * @return ModelItemListDTO[]
     */
    public function find(string $name) : array
    {
        // ...
    }

    /**
     * Checks if base model exists.
     */
    public function isExist(string $name) : bool
    {
        // ...
    }

    /**
     * Adds base model.
     *
     * @param BaseModelCreationViewModel $model
     * new base model's data.
     * @param BaseModelCreationErrors $errors
     * An object for storing operation errors.
     */
    public function add(BaseModelCreationViewModel $model,
                        BaseModelCreationErrors $errors) : void
    {
        // ...
    }


    /**
     * Updates base model.
     *
     * @param BaseModelUpdateViewModel $model New base model's data.
     * @param BaseModelUpdateErrors $errors
     * An object for storing operation errors.
     */
    public function update(BaseModelUpdateViewModel $model,
                           BaseModelUpdateErrors $errors) : void
    {
        // ...
    }

    /**
     * Deletes base model.
     *
     * @param int $id Identifier of the base model
     */
    public function remove(int $id) : void
    {
        // ...
    }

    /**
     * Returns the thumbnail's filename of base model.
     *
     * @param int $id Identifier of the base model
     */
    public function getThumbnail(int $id) : string
    {
        // ...
    }

    /**
     * Returns the image's filenames of base model's gallery.
     *
     * @param int[] $ids Array of gallery images identifiers
     */
    public function getGalleryImages(array $ids) : array
    {
        // ...
    }
}
