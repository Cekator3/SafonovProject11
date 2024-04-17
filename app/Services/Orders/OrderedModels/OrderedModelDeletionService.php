<?php

namespace App\Services\Orders\OrderedModels;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Orders\OrderRepository;
use App\Repositories\Orders\OrderedModelRepository;

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
     */
    public function remove(int $orderedModelId) : void
    {
        $userId = Auth::user()->id;
        $currentOrderId = $this->getUserCurrentOrderId();
        if ($currentOrderId === null)
        {
            assert(false, 'Something is wrong');
            return;
        }

        $models = new OrderedModelRepository();
        $models->remove($orderedModelId, $userId, $currentOrderId);
    }
}
