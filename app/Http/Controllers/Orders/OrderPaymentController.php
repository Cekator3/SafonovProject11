<?php

namespace App\Http\Controllers\Orders;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\Orders\OrderedModels\OrderedModelGetterService;

class OrderPaymentController
{
    /**
     * Displays the history of user's orders.
     */
    public function showPaymentNotifier(Request $request) : View
    {
        $models = new OrderedModelGetterService();
        $models = $models->getAllAsShoppingCart();
        return view('orders.payment', ['shoppingCart' => $models]);
    }
}
