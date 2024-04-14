<?php

namespace App\Repositories\Orders;

use App\Errors\Orders\OrderCreationErrors;

/**
 * Subsystem for interaction with stored information on user's orders
 *
 * Current purposes:
 * 1. Retrieving user's order.
 * 2. Retrieving all user's orders.
 * 3. Adding order to user.
 */
class OrdersRepository
{
    /**
     * Retrieves the identifier of the user's not completed (current) order.
     *
     * @return int|null Order identifier.
     * If user don't have one, null will be returned.
     */
    public function getCurrentOrderId(int $userId) : int|null
    {
        // ...
    }

    public function get(int $userId, int $orderId) : OrderDTO
    {
        // 1. Find by id
        // 2. If userId !== $userId then orderId is faked by user
    }

    /**
     * Retrieves all user's orders
     *
     * @return OrderDTO[]
     */
    public function getAll(int $userId) : array
    {
        // ...
    }

    /**
     * Adds new order for user
     */
    public function add(int $userId, int &$orderId, OrderCreationErrors $errors) : void
    {
        // ...
    }
}
