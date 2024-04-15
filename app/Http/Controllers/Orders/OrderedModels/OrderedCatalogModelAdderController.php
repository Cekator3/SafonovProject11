<?php

namespace App\Http\Controllers\Orders\OrderedModels;

use Illuminate\View\View;
use Illuminate\Http\Request;

class OrderedCatalogModelAdderController
{
    /**
     * Displays the form to add a model from the catalog to the user's shopping cart.
     */
    public function showAddCatalogModelToCartForm(Request $request) : View
    {
        // ...
    }

    /**
     * Tries to add a catalog model to the user's order.
     */
    public function addCatalogModelToOrder(Request $request, int $baseModelId) : View
    {
        // ...
    }
}
