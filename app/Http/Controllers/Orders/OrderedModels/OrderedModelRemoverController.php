<?php

namespace App\Http\Controllers\Orders\OrderedModels;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Services\Orders\OrderedModels\OrderedModelDeletionService;

class OrderedModelRemoverController
{
    /**
     * Tries to remove ordered model from user's order.
     */
    public function removeOrderedModel(Request $request, int $orderedModelId) : RedirectResponse
    {
        $models = new OrderedModelDeletionService();
        $models->remove($orderedModelId);
        return redirect()->back();
    }
}
