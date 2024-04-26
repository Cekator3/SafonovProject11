<?php

namespace App\Services\Orders\History;

use Illuminate\Support\Facades\Auth;
use App\DTOs\Orders\History\OrderDTO;
use App\Repositories\Orders\OrderRepository;
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
        $userId = Auth::user()->id;
        $orders = new OrderRepository();
        return $orders->getAll($userId);
    }

    /**
     * Returns details about specific user's order
     */
    public function get(int $orderId) : OrderDTO|null
    {
        $userId = Auth::user()->id;
        $orders = new OrderRepository();
        if (! $orders->belongsToUser($orderId, $userId))
            return null;
        return $orders->get($userId, $orderId);
    }
}
