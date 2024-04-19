<?php

namespace App\Services\Orders\OrderedModels;

use Illuminate\Support\Facades\Auth;
use App\DTOs\Orders\ShoppingCart\ModelDTO;
use App\DTOs\Orders\ShoppingCart\ShoppingCartDTO;
use App\Repositories\Orders\OrderedModelRepository;
use App\Repositories\Images\BaseModelThumbnailRepository;
use App\Repositories\Images\AdditionalServiceThumbnailRepository;
use App\DTOs\Orders\NewOrderedCatalogModel\NewOrderedCatalogModelDTO;
use App\DTOs\Orders\ExistingOrderedCatalogModel\ExistingOrderedCatalogModelDTO;

/**
 * Subsystem for getting stored information on ordered model
 * from user's current order.
 */
class OrderedModelGetterService
{
    /**
     * @param \App\DTOs\Orders\NewOrderedCatalogModel\AdditionalServiceWithPriceDTO[] | \App\DTOs\Orders\ExistingOrderedCatalogModel\AdditionalServiceWithPriceDTO[] $additionalServices
     */
    private function setAdditionalServicesThumbnailsUrls(array $additionalServices) : void
    {
        $thumbnails = new AdditionalServiceThumbnailRepository();
        foreach ($additionalServices as $additionalService)
        {
            $filename = $additionalService->getPreviewImageFilename();
            $url = $thumbnails->get($filename);
            $additionalService->setPreviewImageUrl($url);
        }
    }

    /**
     * Returns ordered model from user's order.
     *
     * Returns null if ordered model not exists
     * or if this ordered model do not belong to user.
     */
    public function get(int $orderedModelId) : ExistingOrderedCatalogModelDTO|null
    {
        $models = new OrderedModelRepository();
        $userId = Auth::user()->id;

        $model = $models->get($orderedModelId, $userId);
        if ($model === null)
            return null;

        $this->setAdditionalServicesThumbnailsUrls($model->getAdditionalServices());

        return $model;
    }

    /**
     * Returns data required to add a model
     * from the catalogue to the user's order.
     */
    public function getOnlyCatalogPrices(int $modelId) : NewOrderedCatalogModelDTO | null
    {
        $models = new OrderedModelRepository();

        $model = $models->getOnlyCatalogPrices($modelId);
        if ($model === null)
            return null;

        $this->setAdditionalServicesThumbnailsUrls($model->getAdditionalServices());

        return $model;
    }

    /**
     * @param ModelDTO[] $models
     */
    private function setModelsThumbnailsUrls(array $models) : void
    {
        $thumbnails = new BaseModelThumbnailRepository();
        foreach ($models as $model)
        {
            $filename = $model->getThumbnailFilename();
            $url = $thumbnails->get($filename);
            $model->setThumbnailUrl($url);
        }
    }

    /**
     * Retrieves all models from order to display them in
     * shopping cart.
     */
    public function getAllAsShoppingCart(int $orderId) : ShoppingCartDTO
    {
        $models = new OrderedModelRepository();
        $userId = Auth::user()->id;

        $shoppingCart = $models->getAllAsShoppingCart($orderId, $userId);

        $this->setModelsThumbnailsUrls($shoppingCart->getModels());

        return $shoppingCart;
    }
}
