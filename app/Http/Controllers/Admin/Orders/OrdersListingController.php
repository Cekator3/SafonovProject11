<?php

namespace App\Http\Controllers\Admin\Orders;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Enums\HttpResponseStatus;
use App\Services\Admin\Orders\OrdersGetterService;

class OrdersListingController
{
    /**
     * Shows the list of users orders
     */
    public function showOrders() : View
    {
        $orders = new OrdersGetterService();

        return view('admin.orders.listing', ['orders' => $orders->getAll()]);
    }

    /**
     * Show the order's details
     */
    public function showOrderDetails(Request $request, int $orderId) : View
    {
        $orders = new OrdersGetterService();

        $order = $orders->get($orderId);
        if ($order === null)
            abort(HttpResponseStatus::NotFound->value);

        return view('admin.orders.order-details', ['order' => $order]);
    }
}
