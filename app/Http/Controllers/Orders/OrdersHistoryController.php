<?php

namespace App\Http\Controllers\Orders;

use Illuminate\View\View;
use Illuminate\Http\Request;

class OrdersHistoryController
{
    /**
     * Displays the history of user's orders.
     */
    public function showOrdersHistory(Request $request) : View
    {
        // ...
    }

    /**
     * Displays details about user's order.
     */
    public function showOrderDetails(Request $request, int $orderId) : View
    {
        // ...
    }
}
