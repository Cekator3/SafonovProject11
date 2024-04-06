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
    }

    /**
     * Tries to create a new filament type
     *
     * @param Request $request User's input
     */
    public function createPrintingTechnology(Request $request) : RedirectResponse
    {
        // ...
    }
}
