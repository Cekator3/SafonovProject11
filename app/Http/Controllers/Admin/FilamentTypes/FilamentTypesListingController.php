<?php

namespace App\Http\Controllers\Admin\FilamentTypes;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\DTOs\Admin\FilamentTypes\FilamentTypeItemListDTO;
use App\DTOs\Admin\PrintingTechnologies\PrintingTechnologyDTO;

class FilamentTypesListingController
{
    private function getTestData(int $amount, int $techAmount) : array
    {
        for ($i = 0; $i < $amount; $i++)
        {
            $printingTechnologies = [];
            for ($j = 0; $j < $techAmount; $j++)
                $printingTechnologies []= new PrintingTechnologyDTO($i, fake()->name(), '');

            $result []= new FilamentTypeItemListDTO($i, "test{$i}", $printingTechnologies);
        }

        return $result;
    }

    public function showFilamentTypes(Request $request) : View
    {
        // ...
        return view('admin.filament-types.list', ['filamentTypes' => $this->getTestData(15, 15)]);
    }
}
