<?php

namespace App\Http\Controllers\Admin\PrintingTechnologies;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PrintingTechnologyCreationController
{
    public function showCreationForm() : View
    {
        // ...
        return view('admin.printing-technologies.create');
    }

    /**
     * Tries to create a new printing technology
     *
     * @param Request $request User's input
     */
    public function createPrintingTechnology(Request $request) : RedirectResponse
    {
        // ...
    }
}
