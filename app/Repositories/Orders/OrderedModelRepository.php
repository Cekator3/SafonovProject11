<?php

namespace App\Repositories\Orders;

use App\Errors\Orders\OrderedModelUpdateErrors;
use App\Errors\Orders\OrderModelAdditionErrors;
use App\DTOs\Orders\ShoppingCart\ShoppingCartDTO;
use App\ViewModels\Orders\OrderedCatalogModelViewModel;
use App\DTOs\Orders\NewOrderedCatalogModel\NewOrderedCatalogModelDTO;
use App\DTOs\Orders\ExistingOrderedCatalogModel\ExistingOrderedCatalogModelDTO;

/**
 * Subsystem for interaction with stored information on order's models.
 *
 * Current purposes:
 * 1. Retrieving models from particular order
 * 2. Adding a new model to an order
 * 3. Updating details of an ordered model
 * 4. Removing a model from an order
 * 5. Checking if a model exists in an order.
 */
class OrderedModelRepository
{
    /**
     * Fetches a model from order.
     *
     * Returns null if ordered model not exists
     * or if this ordered model do not belong to user.
     *
     * @param int $id Ordered model's identifier
     */
    public function get(int $id, int $userId) : ExistingOrderedCatalogModelDTO | null
    {
        // ...
    }

    /**
     * Returns data required to add a model
     * from the catalogue to the user's order.
     *
     * @param int $modelId Base model's identifier
     */
    public function getOnlyCatalogPrices(int $modelId) : NewOrderedCatalogModelDTO
    {
        // ...
    }

    /**
     * Retrieves all models from order to display them in
     * shopping cart.
     *
     * @return ShoppingCartDTO
     *
     * TODO OrderedModelsRepository is too abstract:
     * admins functionalities need one piece of information,
     * print masters functionalities - another,
     * customers - another.
     */
    public function getAllAsShoppingCart(int $userId, int $orderId) : ShoppingCartDTO
    {
        // ...
    }

    /**
     * Removes a model from the order.
     *
     * @param int $id Ordered model's identifier
     * @param int $userId Identifier of the user whose ordered model will be removed
     * @param int $orderId Identifier of the order from which the model will be removed
     */
    public function remove(int $id, int $userId, int $orderId) : void
    {
        // ...
    }

    /**
     * Checks if the model with given configuration is in the user's order
     */
    public function exists(OrderedCatalogModelViewModel $model, int $userId, int $orderId) : bool
    {
        // ...
    }

    /**
     * Adds model to the order.
     *
     * @param OrderedCatalogModelViewModel $model
     * Information on new ordered model.
     * @param OrderModelAdditionErrors $errors
     * An object for storing operation errors.
     */
    public function add(OrderedCatalogModelViewModel $model,
                        int $orderId,
                        OrderModelAdditionErrors $errors) : void
    {
        // ...
    }

    /**
     * Updates model in the order
     *
     * @param OrderedCatalogModelViewModel $model
     * Information on ordered model.
     * @param OrderedModelUpdateErrors $errors
     * An object for storing operation errors.
     */
    public function update(OrderedCatalogModelViewModel $model,
                           int $orderId,
                           OrderedModelUpdateErrors $errors) : void
    {
        // ...
    }
}
