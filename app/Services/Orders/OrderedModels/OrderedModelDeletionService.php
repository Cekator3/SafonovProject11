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
        $models = new OrderedModelRepository();

        if ($models->belongsToUser($orderedModelId, $userId))
            $models->remove($orderedModelId);
    }
}
