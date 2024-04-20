<?php

namespace App\Http\Controllers\Orders\OrderedModels;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\Orders\OrderedModels\OrderedModelGetterService;

class ShoppingCartItemsListingController
{
    /**
     * Tries to remove ordered model from user's order.
     */
    public function showItems(Request $request) : View
    {
        $models = new OrderedModelGetterService();
        $models = $models->getAllAsShoppingCart();
        return view('orders.shopping-cart', ['shoppingCart' => $models]);
    }
}
