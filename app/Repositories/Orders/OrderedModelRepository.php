<?php

namespace App\Repositories\Orders;

use App\Errors\Orders\OrderedModelUpdateErrors;
use App\Errors\Orders\OrderModelAdditionErrors;
use App\DTOs\Orders\ShoppingCart\ShoppingCartDTO;
use App\ViewModels\Orders\OrderedCatalogModelViewModel;
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
     */
    public function get(int $orderId, int $modelId) : ExistingOrderedCatalogModelDTO
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
    public function getAllAsShoppingCart(int $orderId) : ShoppingCartDTO
    {
        // ...
    }

    /**
     * Removes a model from the order.
     */
    public function remove(int $orderId, int $modelId) : void
    {
        // ...
    }

    /**
     * Checks if the model is in the order.
     */
    public function exists(int $orderId, int $modelId) : bool
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
    public function add(int $orderId,
                        OrderedCatalogModelViewModel $model,
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
    public function update(int $orderId,
                           OrderedCatalogModelViewModel $model,
                           OrderedModelUpdateErrors $errors) : void
    {
        // ...
    }
}