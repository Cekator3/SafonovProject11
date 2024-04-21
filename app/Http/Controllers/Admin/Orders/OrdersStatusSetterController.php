<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Enums\OrderStatus;
use App\Services\Admin\Orders\OrderStatusSetterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class OrdersStatusSetterController
{
    /**
     * Shows the list of users orders
     */
    public function setOrderStatus(Request $request, int $orderId) : RedirectResponse
    {
        $orders = new OrderStatusSetterService();

        $statusValue = $request->integer('status', -1);
        if ($statusValue === -1)
            return redirect()->back();

        $status = OrderStatus::GetByValue($statusValue);
        $orders->setStatus($orderId, $status);

        return redirect()->back();
    }
}
