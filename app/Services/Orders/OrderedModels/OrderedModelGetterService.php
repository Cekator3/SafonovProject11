<?php

namespace App\Services\Orders\OrderedModels;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Orders\OrderRepository;
use App\Repositories\Orders\OrderedModelRepository;
use App\DTOs\Orders\ExistingOrderedCatalogModel\ExistingOrderedCatalogModelDTO;

/**
 * Subsystem for getting stored information on ordered model
 * from user's current order.
 */
class OrderedModelGetterService
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
     * Returns ordered model from user's current order.
     */
    public function get(int $orderedModelId) : ExistingOrderedCatalogModelDTO|null
    {
        // 1. Ensure that the ordered model belongs to the user's current order.
        // 2. Remove the model from user's order
        $currentOrderId = $this->getUserCurrentOrderId();
        if ($currentOrderId === null)
        {
            assert(false, 'Something is wrong');
            return null;
        }

        $models = new OrderedModelRepository();
        return $models->get($currentOrderId, $baseModelId);
    }
}
