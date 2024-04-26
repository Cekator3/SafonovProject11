<?php

namespace App\Http\Controllers\Orders;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Enums\HttpResponseStatus;
use App\Services\Orders\History\OrdersHistoryGetterService;

class OrdersHistoryController
{
    /**
     * Displays the history of user's orders.
     */
    public function showOrdersHistory(Request $request) : View
    {
        $orders = new OrdersHistoryGetterService();
        dd($orders->getAll());
        return view('orders.history.listing', ['orders' => $orders->getAll()]);
    }

    /**
     * Displays details about user's order.
     */
    public function showOrderDetails(Request $request, int $orderId) : View
    {
        $orders = new OrdersHistoryGetterService();
        $order = $orders->get($orderId);
        dd($order);
        if ($order === null)
            return abort(HttpResponseStatus::NotFound->value);
        return view('orders.history.order-details', ['orders' => $orders->get($orderId)]);
    }
}
