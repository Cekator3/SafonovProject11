<?php

namespace App\Services\Orders\OrderedModels;

use App\Errors\UserInputErrors;
use App\Repositories\Orders\OrderRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Orders\OrderedModelRepository;
use App\ViewModels\Orders\OrderedCatalogModelViewModel;

/**
 * Subsystem for removing stored information on ordered models
 * from user's current order.
 */
class OrderedModelDeletionService
{
    /**
     * Returns user's current order if exists.
     */
    private function getUserCurrentOrderId() : int|null
    {
        $userId = Auth::user()->id;
        $orders = new OrderRepository();
        return $orders->getCurrentOrderId($userId);
    }

    /**
     * Removes a model from the user's current order.
     *
     * @param int $baseModelId The identifier of the ordered model.
     */
    public function remove(int $orderedModelId) : void
    {
        // 1. Ensure that the ordered model belongs to the user's current order.
        // 2. Remove the model from user's order

        $userId = Auth::user()->id;
        $models = new OrderedModelRepository();
        $currentOrderId = $this->getUserCurrentOrderId();
        if ($currentOrderId === null)
        {
            assert(false, 'Something is wrong');
            return null;
        }

        $models->remove($currentOrderId, $baseModelId);
    }
}
