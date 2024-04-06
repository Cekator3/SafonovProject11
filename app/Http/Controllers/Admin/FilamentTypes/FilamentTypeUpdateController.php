<?php

namespace App\Http\Controllers\Admin\FilamentTypes;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\DTOs\Admin\FilamentTypes\FilamentTypeDTO;
use App\DTOs\Admin\FilamentTypes\FilamentTypeCharacteristics;
use App\DTOs\Admin\PrintingTechnologies\PrintingTechnologyDTO;

class FilamentTypeUpdateController
{
    private function getTestData(int $techAmount) : FilamentTypeDTO
    {
        $stats = new FilamentTypeCharacteristics(1, 2, 3, 4, 0, 15, true);

        $res = [];
        for ($i = 0; $i < $techAmount; $i++)
            $res []= new PrintingTechnologyDTO($i, fake()->text(), fake()->text());

        return new FilamentTypeDTO(1, 'test', 'test', $stats, $res);
    }

    public function showUpdatingForm(int $filamentTypeId) : View
    {
        // ...
        return view('admin.filament-types.update', ['filamentType' => $this->getTestData(5)]);
    }

    /**
     * Tries to update a filament type
     */
    public function updateFilamentType(Request $request, int $filamentTypeId) : RedirectResponse
    {
        // ...
        return redirect()->route('filament-types');
    }
}
