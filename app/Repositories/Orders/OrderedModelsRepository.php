<?php

namespace App\Repositories\Orders;

use App\Errors\Orders\OrderedModelUpdateErrors;
use App\Errors\Orders\OrderModelAdditionErrors;
use App\ViewModels\Orders\OrderedCatalogModelViewModel;
use App\DTOs\Orders\ExistingOrderedCatalogModel\ExistingOrderedCatalogModelDTO;

/**
 * Subsystem for interaction with stored information on models orders
 */
class OrderedModelsRepository
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
     * @param int $modelId Model to be removed
     * @return ExistingOrderedCatalogModelDTO[]
     */
    public function getAllFromOrder(int $orderId) : array
    {
        // ...
    }

    /**
     * Adds model to the user's current order.
     *
     * @param OrderedCatalogModelViewModel $model
     * Information on new ordered model.
     * @param OrderModelAdditionErrors $errors
     * An object for storing operation errors.
     */
    public function add(OrderedCatalogModelViewModel $model,
                        OrderModelAdditionErrors $errors) : void
    {
        // ...
    }

    /**
     * Updates model from the user's current order
     *
     * @param OrderedCatalogModelViewModel $model
     * Information on ordered model.
     * @param OrderedModelUpdateErrors $errors
     * An object for storing operation errors.
     */
    public function update(OrderedCatalogModelViewModel $model,
                           OrderedModelUpdateErrors $errors) : void
    {
        // ...
    }

    /**
     * Removes model from the user's current order
     *
     * @param int $userId
     * User from whose order the model will be removed
     * @param int $modelId Model to be removed
     */
    public function remove(int $userId, int $modelId) : void
    {
        // ...
    }
}
