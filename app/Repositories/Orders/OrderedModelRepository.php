<?php

namespace App\Repositories\Orders;

use App\ViewModels\Orders\OrderedCatalogModelViewModel;
use App\DTOs\Orders\ExistingOrderedCatalogModel\ExistingOrderedCatalogModelDTO;

/**
 * Subsystem for interaction with stored information on models orders
 */
class OrderedModelRepository
{
    /**
     * Returns model from the user's current order.
     */
    public function get(int $userId, int $modelId) : ExistingOrderedCatalogModelDTO
    {
        // ...
    }

    /**
     * Returns all models from the user's current order.
     *
     * @return ExistingOrderedCatalogModelDTO[]
     */
    public function getAll(int $userId) : array
    {
        // ...
    }

    /**
     * Returns all models from the user's order.
     *
     * @return ExistingOrderedCatalogModelDTO[]
     */
    public function getAllFromOrder(int $userId, int $orderId) : array
    {
        // ...
    }

    /**
     * Adds model to the user's current order.
     */
    public function add(OrderedCatalogModelViewModel $model) : void
    {
        // ...
    }

    /**
     * Updates model from the user's current order
     */
    public function update(OrderedCatalogModelViewModel $model) : void
    {
        // ...
    }

    /**
     * Removes model from the user's current order
     */
    public function remove(int $userId, int $modelId) : void
    {
        // ...
    }
}
