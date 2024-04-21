<?php

namespace App\Services\Admin\Orders;

use App\Enums\OrderStatus;
use App\Errors\UserInputErrors;
use App\Repositories\Admin\OrderRepository;

/**
 * Subsystem for updating order's status.
 */
class OrderStatusSetterService
{
    /**
     * Tries to update order's status
     */
    public function setStatus(int $orderId, OrderStatus $status, UserInputErrors $errors) : void
    {
        $orders = new OrderRepository();
        if ($orders->getStatus($orderId) === OrderStatus::Completed)
        {
            $errors->add('status', 'Нельзя изменять статус выполненного заказа');
            return;
        }
        $orders->setStatus($orderId, $status);
    }
}
