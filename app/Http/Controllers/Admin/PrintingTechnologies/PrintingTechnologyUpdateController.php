<?php

namespace App\Http\Controllers\Admin\PrintingTechnologies;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PrintingTechnologyUpdateController
{
    public function showUpdatingForm(int $additionalServiceId) : View
    {
        // ...
    }

    /**
     * Tries to update a printing technology
     */
    public function updatePrintingTechnology(Request $request, int $printingTechnologyId) : RedirectResponse
    {
        // ...
    }
}
