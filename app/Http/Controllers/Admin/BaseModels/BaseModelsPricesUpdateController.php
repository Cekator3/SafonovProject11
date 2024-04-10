<?php

namespace App\Http\Controllers\Admin\BaseModels;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class BaseModelsPricesUpdateController
{
    public function showUpdatingForm(int $baseModelId) : View
    {
        return view('admin.base-models.update-prices');
    }

    /**
     * Tries to update a base model
     */
    public function updateBaseModel(Request $request, int $baseModelId) : RedirectResponse
    {
        dd($request->input());
        // ...
        return redirect()->route('base-models');
    }
}
