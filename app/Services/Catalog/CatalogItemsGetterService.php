<?php

namespace App\Services\Catalog;

use APP\DTOs\Catalog\CatalogItemDTO;
use APP\DTOs\Catalog\CatalogItemListDTO;
use App\Repositories\Catalog\CatalogItemsRepository;
use App\Repositories\Images\BaseModelThumbnailRepository;


/**
 * Subsystem for getting stored information on catalog items.
 */
class CatalogItemsGetterService
{
    private function setThumbnailUrl(CatalogItemDTO|CatalogItemListDTO $model) : void
    {
        $thumbnails = new BaseModelThumbnailRepository();

        $url = $thumbnails->get($model->getPreviewImageFilename());

        $model->setPreviewImageUrl($url);
    }

    /**
     * Returns all catalog items.
     * @return CatalogItemListDTO[]
     */
    public function getAll() : array
    {
        $models = new CatalogItemsRepository();
        $result = $models->getAll();

        foreach ($result as $model)
            $this->setThumbnailUrl($model);

        return $result;
    }

    /**
     * Returns catalog item
     */
    public function get(int $baseModelId) : CatalogItemDTO|null
    {
        $models = new CatalogItemsRepository();
        $result = $models->get($baseModelId);

        if ($result !== null)
            $this->setThumbnailUrl($result);

        return $result;
    }

    /**
     * Finds all the relevant catalog items
     *
     * @return CatalogItemListDTO[]
     */
    public function find(string $name) : array
    {
        $models = new CatalogItemsRepository();
        $result = $models->find($name);

        foreach ($result as $model)
            $this->setThumbnailUrl($model);

        return $result;
    }
}
