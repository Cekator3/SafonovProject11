<?php

namespace App\Services\Orders\History;

use App\DTOs\Orders\History\OrderDTO;
use App\DTOs\Orders\History\OrderItemListDTO;

/**
 * Subsystem for getting stored information about user's orders history.
 */
class OrdersHistoryGetterService
{
    /**
     * Returns history of all user's orders
     *
     * @return OrderItemListDTO[]
     */
    public function getAll() : array
    {
        // ...
    }

    /**
     * Returns details about specific user's order
     */
    public function get(int $orderId) : OrderDTO|null
    {
        // ...
    }
}
