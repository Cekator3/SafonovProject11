<?php

namespace App\Repositories\Admin;

use App\Enums\OrderStatus;
use Illuminate\Support\Facades\DB;
use App\DTOs\Admin\Orders\OrderDTO;
use App\DTOs\Orders\History\OrderItemListDTO;

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
    public function getStatus(int $orderId) : OrderStatus|null
    {
        $entry = DB::table('orders')->select('status')->find($orderId);

        if ($entry === null)
            return null;

        return OrderStatus::GetByValue($entry);
    }

    /**
     * Sets new status to order.
     */
    public function setStatus(int $orderId, OrderStatus $status) : void
    {
        DB::table('orders')->where('id', $orderId)
                           ->update(['status' => $status]);
    }
}
