<?php

namespace App\Services\Orders;

use App\Errors\UserInputErrors;
use App\ViewModels\Orders\OrderedCatalogModelViewModel;

/**
 * Subsystem for storing information about a new model
 * for the user's current order.
 */
class CatalogModelOrderUpdateService
{
    /**
     * Tries to add a new model to the user's current order.
     *
     * @param OrderedCatalogModelViewModel $model
     * User's input about a new model for the user's current order.
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function update(OrderedCatalogModelViewModel $model,
                           UserInputErrors $errors) : void
    {
        // ...
    }
}
