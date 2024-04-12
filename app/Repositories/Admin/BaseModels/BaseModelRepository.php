<?php

namespace App\Repositories\Admin\BaseModels;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\DTOs\Admin\BaseModels\BaseModelDTO;
use App\DTOs\Admin\BaseModels\ModelItemListDTO;
use App\ViewModels\Admin\BaseModel\BaseModelSize;
use App\Errors\Admin\BaseModel\BaseModelUpdateErrors;
use App\Errors\Admin\BaseModel\BaseModelCreationErrors;
use Illuminate\Database\UniqueConstraintViolationException;
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
        return DB::table('models')->where('name', $name)->exists();
    }

    /**
     * @param BaseModelSize[] $sizes
     */
    private function addModelSizes(int $modelId, array $sizes) : void
    {
        $data = [];

        foreach ($sizes as $size)
        {
            $data []= [
                'model_id' => $modelId,
                'size_multiplier' => $size->multiplier,
                'length' => $size->length,
                'height' => $size->height,
                'width' => $size->width,
            ];
        }

        DB::table('models_sizes')->insert($data);
    }

    /**
     * @param string[] $images filenames of model's gallery images
     */
    private function addGalleryImages(int $modelId, array $images) : void
    {
        $data = [];

        foreach ($images as $image)
        {
            $data [] = [
                'model_id' => $modelId,
                'image' => $image
            ];
        }

        DB::table('models_gallery_images')->insert($data);
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
        try
        {
            $modelId = DB::table('models')->insertGetId([
                'name' => $model->name,
                'description' => $model->description,
                'preview_image' => $model->thumbnailFilename,
            ]);
        }
        catch (UniqueConstraintViolationException $e)
        {
            $errors->add(BaseModelCreationErrors::ERROR_BASE_MODEL_ALREADY_EXIST);
            return;
        }

        $this->addModelSizes($modelId, $model->modelSizes);
        $this->addGalleryImages($modelId, $model->galleryImagesFilenames);
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
     * @return string[] Filenames of base mode's gallery images
     */
    public function getGalleryImages(array $ids) : array
    {
        // ...
    }

    /**
     * Returns all image's filenames of base model's gallery.
     *
     * @return string[] Filenames of base mode's gallery images
     */
    public function getAllGalleryImages() : array
    {
        // ...
    }
}
