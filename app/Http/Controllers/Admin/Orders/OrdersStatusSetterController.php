<?php

namespace App\Http\Controllers\Admin\Orders;

use Illuminate\View\View;
use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use Illuminate\Http\RedirectResponse;
use App\Services\Admin\Orders\OrderStatusSetterService;

class OrdersStatusSetterController
{
    /**
     * Shows the list of users orders
     */
    public function setOrderStatus(Request $request, int $orderId) : RedirectResponse
    {
        $orders = new OrderStatusSetterService();

        $statusValue = $request->integer('status', -1);
        $errors = new UserInputErrors();
        if (! OrderStatus::HasValue($statusValue))
        {
            $errors->add('status', 'Неизвестное значение статуса заказа');
            return redirect()->back()
                             ->withErrors($errors->getAll());
        }

        $status = OrderStatus::GetByValue($statusValue);
        $orders->setStatus($orderId, $status, $errors);

        if ($errors->hasAny())
        {
            return redirect()->back()
                             ->withErrors($errors->getAll());
        }

        return redirect()->back();
    }
}
