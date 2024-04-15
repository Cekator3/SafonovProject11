<?php

namespace App\Services\Orders\OrderedModels;

use App\Errors\UserInputErrors;
use App\ViewModels\Orders\OrderedCatalogModelViewModel;

/**
 * Subsystem for removing stored information on ordered models
 * from user's current order.
 */
class OrderedModelDeletionService
{
    /**
     * Removes a model from the user's current order.
     *
     * @param int $id The identifier of the base model.
     */
    public function remove(int $id) : void
    {
        // ...
    }
}
