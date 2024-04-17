<?php

namespace App\Services\Orders\OrderedModels;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Orders\OrderRepository;
use App\DTOs\Orders\ShoppingCart\ShoppingCartDTO;
use App\Repositories\Orders\OrderedModelRepository;
use App\DTOs\Orders\NewOrderedCatalogModel\NewOrderedCatalogModelDTO;
use App\DTOs\Orders\ExistingOrderedCatalogModel\ExistingOrderedCatalogModelDTO;

/**
 * Subsystem for getting stored information on ordered model
 * from user's current order.
 */
class OrderedModelGetterService
{
    /**
     * Returns user's current order if exists.
     */
    private function getUserCurrentOrderId(int $userId) : int|null
    {
        $orders = new OrderRepository();
        return $orders->getCurrentOrderId($userId);
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
        return $models->get($orderedModelId, $userId);
    }

    /**
     * Returns data required to add a model
     * from the catalogue to the user's order.
     */
    public function getOnlyCatalogPrices(int $modelId) : NewOrderedCatalogModelDTO
    {
        $models = new OrderedModelRepository();
        return $models->getOnlyCatalogPrices($modelId);
    }

    /**
     * Retrieves all models from order to display them in
     * shopping cart.
     */
    public function getAllAsShoppingCart(int $orderId) : ShoppingCartDTO
    {
        $models = new OrderedModelRepository();
        $userId = Auth::user()->id;
        return $models->getAllAsShoppingCart($orderId, $userId);
    }
}
