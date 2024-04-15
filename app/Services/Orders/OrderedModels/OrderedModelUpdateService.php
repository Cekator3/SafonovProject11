<?php

namespace App\Services\Orders\OrderedModels;

use App\Errors\UserInputErrors;
use App\ViewModels\Orders\OrderedCatalogModelViewModel;

/**
 * Subsystem for updating stored information about ordered models
 * from the user's current order.
 */
class OrderedModelUpdateService
{
    /**
     * Tries to update an ordered model from the user's current order
     *
     * @param OrderedCatalogModelViewModel $model
     * User's input about a new ordered model's details.
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function update(OrderedCatalogModelViewModel $model,
                           UserInputErrors $errors) : void
    {
        // ...
    }
}
