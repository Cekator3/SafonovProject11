<?php

namespace App\Http\Controllers\Admin\FilamentTypes;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class FilamentTypeUpdateController
{
    public function showUpdatingForm(int $filamentTypeId) : View
    {
        // ...
    }

    /**
     * Tries to update a filament type
     */
    public function updateFilamentType(Request $request, int $filamentTypeId) : RedirectResponse
    {
        // ...
    }
}
