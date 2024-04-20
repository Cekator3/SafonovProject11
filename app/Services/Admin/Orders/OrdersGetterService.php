<?php

namespace App\Services\Admin\Orders;

use App\DTOs\Admin\Orders\OrderDTO;
use App\DTOs\Admin\Orders\OrderItemListDTO;
use App\Repositories\Admin\OrderRepository;

/**
 * Subsystem for getting stored information on orders (admin).
 */
class OrdersGetterService
{
    /**
     * Retrieves all orders.
     *
     * @return OrderItemListDTO[]
     */
    public function getAll() : array
    {
        $orders = new OrderRepository();
        return $orders->getAll();
    }

    /**
     * Retrieves order with its models
     */
    public function get(int $orderId) : OrderDTO|null
    {
        $orders = new OrderRepository();
        return $orders->get($orderId);
    }
}
