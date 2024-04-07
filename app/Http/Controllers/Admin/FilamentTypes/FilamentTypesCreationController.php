<?php

namespace App\Http\Controllers\Admin\FilamentTypes;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\DTOs\Admin\PrintingTechnologies\PrintingTechnologyNameOnlyDTO;

class FilamentTypesCreationController
{
    public function showCreationForm() : View
    {
        $res = [];
        for ($i = 0; $i < 15; $i++)
            $res []= new PrintingTechnologyNameOnlyDTO($i, fake()->text());
        return view('admin.filament-types.create', ['printingTechnologies' => $res]);
    }

    /**
     * Tries to create a new filament type
     *
     * @param Request $request User's input
     */
    public function createFilamentType(Request $request) : RedirectResponse
    {
        // ...
        return redirect()->route('filament-types');
    }
}
