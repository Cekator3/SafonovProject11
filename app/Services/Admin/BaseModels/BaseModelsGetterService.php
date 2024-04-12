<?php

namespace App\Services\Admin\BaseModels;

use App\DTOs\Admin\BaseModels\BaseModelDTO;
use App\DTOs\Admin\BaseModels\ModelItemListDTO;
use App\Repositories\Admin\BaseModels\BaseModelRepository;
use App\Repositories\Images\BaseModelGalleryImagesRepository;
use App\Repositories\Images\BaseModelThumbnailRepository;


/**
 * Subsystem for getting stored information on base model.
 */
class BaseModelsGetterService
{
    private function setThumbnailUrl(BaseModelDTO|ModelItemListDTO $model) : void
    {
        $thumbnails = new BaseModelThumbnailRepository();

        $url = $thumbnails->get($model->getPreviewImageFilename());

        $model->setPreviewImageUrl($url);
    }

    private function setGalleryImagesUrls(BaseModelDTO $model) : void
    {
        $gallery = new BaseModelGalleryImagesRepository();
        $images = $model->getGalleryImages();

        foreach ($images as $image)
        {
            $url = $gallery->get($image->getFilename());
            $image->setUrl($url);
        }
    }

    /**
     * Returns all base models.
     * @return ModelItemListDTO[]
     */
    public function getAll() : array
    {
        $models = new BaseModelRepository();
        $result = $models->getAll();

        foreach ($result as $model)
            $this->setThumbnailUrl($model);

        return $result;
    }

    /**
     * Returns base model.
     */
    public function get(int $baseModelId) : BaseModelDTO|null
    {
        $models = new BaseModelRepository();
        $result = $models->get($baseModelId);

        if ($result !== null)
        {
            $this->setThumbnailUrl($result);
            $this->setGalleryImagesUrls($result);
        }

        return $result;
    }

    /**
     * Finds all the relevant base models
     *
     * @return ModelItemListDTO[]
     */
    public function find(string $name) : array
    {
        $models = new BaseModelRepository();
        $result = $models->find($name);

        foreach ($result as $model)
            $this->setThumbnailUrl($model);

        return $result;
    }
}
