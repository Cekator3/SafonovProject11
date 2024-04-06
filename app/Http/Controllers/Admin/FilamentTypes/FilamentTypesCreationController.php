<?php

namespace App\Http\Controllers\Admin\FilamentTypes;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class FilamentTypesCreationController
{
    public function showCreationForm() : View
    {
        // ...
        return view('admin.filament-types.create');
    }

    /**
     * Tries to create a new filament type
     *
     * @param Request $request User's input
     */
    public function createPrintingTechnology(Request $request) : RedirectResponse
    {
        // ...
        return redirect()->route('filament-types');
    }
}
