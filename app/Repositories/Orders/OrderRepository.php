<?php

namespace App\Repositories\Orders;

use App\DTOs\Orders\OrderDTO;
use App\DTOs\Orders\OrderItemListDTO;
use App\Errors\Orders\OrderCreationErrors;

/**
 * Subsystem for interaction with stored information on user's orders
 *
 * Current purposes:
 * 1. Retrieving user's order.
 * 2. Retrieving all user's orders.
 * 3. Adding order to user.
 */
class OrderRepository
{
    /**
     * Retrieves the identifier of the user's not completed (current) order.
     *
     * @return int|null Order identifier.
     * If user don't have one, null will be returned.
     */
    public function getCurrentOrderId(int $userId) : int | null
    {
        // ...
    }

    /**
     * Retrieves user's order.
     */
    public function get(int $userId, int $orderId) : OrderDTO | null
    {
        // ...
    }

    /**
     * Retrieves all user's orders.
     *
     * @return OrderItemListDTO[]
     */
    public function getAll(int $userId) : array
    {
        // ...
    }

    /**
     * Adds new order for user.
     *
     * @param int $orderId Identifier of created order.
     */
    public function add(int $userId, int &$orderId, OrderCreationErrors $errors) : void
    {
        // ...
    }
}
