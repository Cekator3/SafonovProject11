<?php

namespace App\Repositories\Admin;

use stdClass;
use App\Enums\OrderStatus;
use Illuminate\Support\Facades\DB;
use App\DTOs\Admin\Orders\OrderDTO;
use App\DTOs\Admin\Orders\OrderInfo;
use App\DTOs\Admin\Orders\OrderItemListDTO;

/**
 * Subsystem for interaction with stored information on user's orders (administrator)
 */
class OrderRepository
{
    public function getOrderInfo(stdClass $entry) : OrderInfo
    {

    }

    /**
     * Retrieves all orders.
     *
     * @return OrderItemListDTO[]
     */
    public function getAll() : array
    {
        $entries = DB::table('orders AS o')->join('users AS u', 'u.id', '=', 'o.customer_id')
                                ->get(['u.email         AS user_email',
                                       'o.id            AS order_id',
                                       'o.status        AS order_status',
                                       'o.payed_at      AS order_payed_at',
                                       'o.completed_at  AS order_completed_at']);

        $result = [];
        foreach ($entries as $entry)
        {
            $orderInfo = $this->getOrderInfo($entry);
            $result []= new OrderItemListDTO($entry->user_email, $orderInfo);
        }
        return $result;
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
