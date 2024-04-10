<?php

namespace App\Http\Controllers\Admin\BaseModels;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class BaseModelsCreationController
{
    public function showCreationForm() : View
    {
        // ...
        return view('admin.base-models.create');
    }

    /**
     * Tries to create a new base model
     *
     * @param Request $request User's input
     */
    public function createBaseModel(Request $request) : RedirectResponse
    {
        dd($request->input());
        // ...
        return redirect()->route('base-models');
    }
}
