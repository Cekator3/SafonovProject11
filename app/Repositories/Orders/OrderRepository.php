<?php

namespace App\Repositories\Orders;

class OrderRepository
{
    /**
     * Adds model to the user's current order.
     */
    public function addModel(int $userId, $model) : void
    {
        // ...
    }

    /**
     * Removes model from the user's current order
     */
    public function removeModel(int $userId, $model) : void
    {
        // ...
    }

    /**
     * Returns true if model is in the user's current order
     */
    public function isModelIn(int $userId, $model) : bool
    {
        // ...
    }

    /**
     * Returns all models from the user's current order.
     */
    public function getModels(int $userId) : array
    {
        // ...
    }
}
