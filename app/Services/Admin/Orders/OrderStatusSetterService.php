<?php

namespace App\Services\Admin\Orders;

use App\Enums\OrderStatus;
use App\Repositories\Admin\OrderRepository;

/**
 * Subsystem for updating order's status.
 */
class OrderStatusSetterService
{
    /**
     * Tries to update order's status
     */
    public function update(int $orderId, OrderStatus $status) : void
    {
        $orders = new OrderRepository();
        $orders->setStatus($orderId, $status);
    }
}
