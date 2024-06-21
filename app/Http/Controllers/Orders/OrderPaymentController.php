<?php

namespace App\Http\Controllers\Orders;

use App\Enums\OrderStatus;
use Illuminate\View\View;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;
use App\Repositories\Orders\OrderRepository;
use App\Services\Orders\OrderedModels\OrderedModelGetterService;

class OrderPaymentController
{
    private function getUserCurrentOrder(int $userId) : int
    {
        $orders = new OrderRepository();
        return $orders->getCurrentOrderId($userId) ?? -1;
    }

    private function UserCurrentOrderSetStatus(int $orderId, OrderStatus $status) : void
    {
        $orders = new \App\Repositories\Admin\OrderRepository();
        $orders->setStatus($orderId, $status);
    }

    /**
     * Displays the history of user's orders.
     */
    public function showPaymentNotifier(Request $request, int|null $orderId = null) : View
    {
        $userId = Auth::user()->id;
        if ($orderId === null) {
            $orderId = $this->getUserCurrentOrder($userId);
            $this->UserCurrentOrderSetStatus($orderId, OrderStatus::WaitingForPayment);
        }

        $models = new OrderedModelGetterService();
        $models = $models->getAllAsShoppingCart($orderId);
        return view('orders.payment', ['shoppingCart' => $models]);
    }
}
