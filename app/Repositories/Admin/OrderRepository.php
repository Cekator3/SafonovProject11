<?php

namespace App\Repositories\Admin;

use App\Enums\OrderStatus;
use Illuminate\Support\Facades\DB;

/**
 * Subsystem for interaction with stored information on user's orders (administrator)
 */
class OrderRepository
{
    /**
     * Retrieves all orders.
     *
     * @return OrderItemListDTO[]
     */
    public function getAll() : array
    {
        // ...
    }

    /**
     * Retrieves order.
     *
     * @return OrderDTO
     */
    public function get(int $orderId) : OrderDTO | null
    {
        // ...
    }

    /**
     * Retrieves order's status
     */
    public function getStatus(int $orderId) : OrderStatus
    {
        // ...
    }

    /**
     * Sets new status to order.
     */
    public function setStatus(int $orderId, OrderStatus $status) : void
    {
        // ...
    }
}
