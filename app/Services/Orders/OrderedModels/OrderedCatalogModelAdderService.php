<?php

namespace App\Services\Orders\OrderedModels;

use App\Errors\UserInputErrors;
use App\ViewModels\Orders\OrderedCatalogModelViewModel;

/**
 * Subsystem for adding a catalog model to the user's current order.
 */
class OrderedCatalogModelAdderService
{
    /**
     * Tries to add a new model to the user's current order.
     *
     * @param OrderedCatalogModelViewModel $model
     * User's input about a new model for the user's current order.
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function add(OrderedCatalogModelViewModel $model,
                        UserInputErrors $errors) : void
    {
        // ...
    }
}
