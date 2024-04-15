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
    private function getUserCurrentOrderId() : int|null
    {
        $userId = Auth::user()->id;
        $orders = new OrderRepository();
        return $orders->getCurrentOrderId($userId);
    }

    /**
     * Removes a model from the user's current order.
     *
     * @param int $baseModelId The identifier of the base model.
     */
    public function remove(int $baseModelId) : void
    {
        $currentOrderId = $this->getUserCurrentOrderId();
        if ($currentOrderId === null)
            return;

        $models = new OrderedModelRepository();
        $models->remove($currentOrderId, $baseModelId);
    }
}
