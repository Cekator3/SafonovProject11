<?php

namespace App\Repositories\Orders;

use stdClass;
use App\Enums\OrderStatus;
use Illuminate\Support\Facades\DB;
use App\DTOs\Orders\History\OrderDTO;
use App\Errors\Orders\OrderCreationErrors;
use App\DTOs\Orders\History\OrderItemListDTO;

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
     * @return int|null User's identifier.
     */
    public function getCurrentOrderId(int $userId) : int | null
    {
        $entry = DB::table('orders')
                           ->where('status', '<>', OrderStatus::Completed)
                           ->where('customer_id', '=', $userId)
                           ->select('id')
                           ->first();
        if ($entry === null)
            return null;
        return $entry->id;
    }

    /**
     * Retrieves the completion status of the user's not completed (current) order.
     *
     * @return int|null User's identifier.
     */
    public function getCurrentOrderStatus(int $userId) : OrderStatus | null
    {
        $entry = DB::table('orders')
                           ->where('status', '<>', OrderStatus::Completed)
                           ->where('customer_id', '=', $userId)
                           ->select('status')
                           ->first();

        if ($entry === null)
            return null;

        return OrderStatus::GetByValue($entry->status);
    }

    private function convertToOrderItemList(stdClass $entry) : OrderItemListDTO
    {
        $id = $entry->id;
        $status = $entry->status;
        $completedAt = $entry->completed_at;
        $payedAt = $entry->payed_at;

        return new OrderItemListDTO($id, $status, $payedAt, $completedAt);
    }

    /**
     * Retrieves all user's orders.
     *
     * @return OrderItemListDTO[]
     */
    public function getAll(int $userId) : array
    {
        $entries = DB::table('orders')->where('customer_id', '=', $userId)
                           ->select('id', 'status', 'payed_at', 'completed_at')
                           ->get();

        $result = [];
        foreach ($entries as $entry)
            $result []= $this->convertToOrderItemList($entry);
        return $result;
    }

    /**
     * Retrieves user's order.
     */
    public function get(int $userId, int $orderId) : OrderDTO | null
    {
        // ordered_models_with_price.sql
    }

    /**
     * Checks if order belongs to user
     */
    public function belongsToUser(int $orderId, int $userId) : bool
    {
        return DB::table('orders')->where('order_id', '=', $orderId)
                                  ->where('user_id', '=', $userId)
                                  ->exists();
    }

    /**
     * Adds new order for user.
     *
     * @param int $orderId Identifier of created order.
     */
    public function add(int $userId, int|null &$orderId, OrderCreationErrors $errors) : void
    {
        $orderId = DB::table('orders')->insertGetId([
            'customer_id' => $userId,
            'status' => OrderStatus::WaitingForPayment
        ]);
    }
}
