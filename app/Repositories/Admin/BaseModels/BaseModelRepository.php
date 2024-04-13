<?php

namespace App\Repositories\Admin\BaseModels;

use stdClass;
use Illuminate\Support\Facades\DB;
use App\DTOs\Admin\BaseModels\BaseModelDTO;
use App\DTOs\Admin\BaseModels\ModelSizeDTO;
use App\DTOs\Admin\BaseModels\ModelItemListDTO;
use App\ViewModels\Admin\BaseModel\BaseModelSize;
use App\DTOs\Admin\BaseModels\ModelGalleryImageDTO;
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
    private function convertToListItem(stdClass $entry) : ModelItemListDTO
    {
        $id = $entry->id;
        $name = $entry->name;
        $previewImage = $entry->preview_image;
        return new ModelItemListDTO($id, $name, $previewImage);
    }

    /**
     * Returns all base models
     *
     * @return ModelItemListDTO[]
     */
    public function getAll() : array
    {
        $entries = DB::table('models')->select(['id', 'name', 'preview_image'])->get();

        $models = [];
        foreach ($entries as $entry)
            $models []= $this->convertToListItem($entry);

        return $models;
    }

    /**
     * Finds all the relevant base models
     *
     * @return ModelItemListDTO[]
     */
    public function find(string $name) : array
    {
        $entries = DB::table('models')
                     ->whereFullText('name', $name)
                     ->select(['id', 'name', 'preview_image'])
                     ->get();

        $models = [];
        foreach ($entries as $entry)
            $models[] = $this->convertToListItem($entry);

        return $models;
    }

    private function convertToGalleryImage(stdClass $entry) : ModelGalleryImageDTO
    {
        return new ModelGalleryImageDTO($entry->id, $entry->image);
    }

    /**
     * @return ModelGalleryImageDTO[]
     */
    private function getGalleryImagesOfModel(int $modelId) : array
    {
        $entries = DB::table('models_gallery_images')
                     ->where('model_id', '=', $modelId)
                     ->get(['id', 'image']);

        $result = [];
        foreach ($entries as $entry)
            $result []= $this->convertToGalleryImage($entry);
        return $result;
    }

    private function convertToModelSize(stdClass $entry) : ModelSizeDTO
    {
        return new ModelSizeDTO($entry->id, $entry->size_multiplier, $entry->length, $entry->width, $entry->height);
    }

    /**
     * @return ModelSizeDTO[]
     */
    private function getSizesOfModel(int $modelId) : array
    {
        $entries = DB::table('models_sizes')
                     ->where('model_id', '=', $modelId)
                     ->get(['id', 'size_multiplier', 'length', 'width', 'height']);

        $result = [];
        foreach ($entries as $entry)
            $result []= $this->convertToModelSize($entry);
        return $result;
    }

    /**
     * Returns base models.
     */
    public function get(int $id) : BaseModelDTO|null
    {
        $entry = DB::table('models')
                   ->where('id', '=', $id)
                   ->first(['name', 'preview_image', 'description']);

        if ($entry === null)
            return null;

        $gallery = $this->getGalleryImagesOfModel($id);
        $sizes = $this->getSizesOfModel($id);
        return new BaseModelDTO($id, $entry->name,
                                     $entry->description,
                                     $entry->preview_image,
                                     $gallery,
                                     $sizes);
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

    private function removeAllModelSizes(int $modelId) : void
    {
        DB::table('models_sizes')->where('model_id', '=', $modelId)->delete();
    }

    /**
     * @param int[] $ids
     */
    private function removeGalleryImages(array $ids) : void
    {
        DB::table('models_gallery_images')->whereIn('id', $ids)->delete();
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
        $newData = [
            'name' => $model->name,
            'description' => $model->description,
        ];
        if (isset($model->thumbnailFilename))
            $newData['preview_image'] = $model->thumbnailFilename;

        try
        {
            DB::table('models')->where('id', '=', $model->id)->update($newData);
        }
        catch (UniqueConstraintViolationException $e)
        {
            $errors->add(BaseModelUpdateErrors::ERROR_BASE_MODEL_ALREADY_EXIST);
            return;
        }

        if (!empty($model->removedGalleryImages))
            $this->removeGalleryImages($model->removedGalleryImages);
        $this->removeAllModelSizes($model->id);
        $this->addModelSizes($model->id, $model->modelSizes);
        if (!empty($model->newGalleryImagesFilenames))
            $this->addGalleryImages($model->id, $model->newGalleryImagesFilenames);
    }

    /**
     * Deletes base model.
     *
     * @param int $id Identifier of the base model
     */
    public function remove(int $id) : void
    {
        DB::table('models')->delete($id);
    }

    /**
     * Returns the thumbnail's filename of base model.
     *
     * @param int $id Identifier of the base model
     */
    public function getThumbnail(int $id) : string|null
    {
        $entry = DB::table('models')->find($id, ['preview_image']);
        if ($entry === null)
            return null;
        return $entry->preview_image;
    }

    /**
     * Returns the image's filenames of base model's gallery.
     *
     * @param int[] $ids Array of gallery images identifiers
     * @return string[] Filenames of base mode's gallery images
     */
    public function getGalleryImages(array $ids) : array
    {
        return DB::table('models_gallery_images')
                 ->whereIn('id', $ids)
                 ->select('image')
                 ->get()
                 ->pluck('image')
                 ->all();
    }

    /**
     * Returns all image's filenames of base model's gallery.
     *
     * @return string[] Filenames of base mode's gallery images
     */
    public function getAllGalleryImages() : array
    {
        return DB::table('models_gallery_images')
                 ->select('image')
                 ->get()
                 ->pluck('image')
                 ->all();
    }
}
