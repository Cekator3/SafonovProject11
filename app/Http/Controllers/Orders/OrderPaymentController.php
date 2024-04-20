<?php

namespace App\Http\Controllers\Orders;

use App\Enums\HttpResponseStatus;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Orders\OrderRepository;

class OrderPaymentController
{
    /**
     * Displays the history of user's orders.
     */
    public function showPaymentNotifier(Request $request) : View
    {
        $userId = Auth::user()->id;
        $orders = new OrderRepository();
        $orderId = $orders->getCurrentOrderId($userId);

        if ($orderId === null)
            abort(HttpResponseStatus::NotFound->value);

        return view('orders.payment', ['orderId' => $orderId]);
    }
}
