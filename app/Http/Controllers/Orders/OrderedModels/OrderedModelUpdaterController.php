<?php

namespace App\Http\Controllers\Orders\OrderedModels;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class OrderedModelUpdaterController
{
    /**
     * Displays the form to update the ordered model.
     */
    public function showUpdateModelForm(Request $request) : View
    {
        // ...
    }

    /**
     * Tries to update details of ordered model.
     */
    public function updateOrderedModel(Request $request, int $baseModelId) : RedirectResponse
    {
        // ...
    }
}
