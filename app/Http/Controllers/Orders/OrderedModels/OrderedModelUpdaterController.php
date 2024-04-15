<?php

namespace App\Http\Controllers\Orders\OrderedModels;

use Illuminate\View\View;
use Illuminate\Http\Request;

class OrderedModelUpdaterController
{
    /**
     * Tries to remove ordered model from user's order.
     */
    public function removeOrderedModel(Request $request, int $baseModelId) : View
    {
        // ...
    }
}
