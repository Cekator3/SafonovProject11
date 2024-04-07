<?php

namespace App\Http\Controllers\Admin\FilamentTypes;

use App\ViewModels\Admin\FilamentType\FilamentTypeUpdateViewModel;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\DTOs\Admin\FilamentTypes\FilamentTypeDTO;
use App\DTOs\Admin\FilamentTypes\FilamentTypeCharacteristics;
use App\DTOs\Admin\PrintingTechnologies\PrintingTechnologyNameOnlyDTO;

class FilamentTypeUpdateController
{
    private function getTestData(int $techAmount) : FilamentTypeDTO
    {
        $stats = new FilamentTypeCharacteristics(1, 2, 3, 4, -10, 15, true);

        $res = [];
        for ($i = 0; $i < $techAmount; $i++)
            $res []= new PrintingTechnologyNameOnlyDTO($i, fake()->text());

        return new FilamentTypeDTO(1, 'test', 'test', $stats, $res);
    }

    public function showUpdatingForm(int $filamentTypeId) : View
    {
        // ...
        $data = $this->getTestData(6);
        return view('admin.filament-types.update', ['filamentType' => $data, 'printingTechnologies' => $data->getPrintingTechnologies()]);
    }

    private function convertToIntArray(array $stringArr) : array
    {
        return array_map('intval', $stringArr);
    }

    private function getUserInput(Request $request, int $filamentTypeId) : FilamentTypeUpdateViewModel
    {
        $userInput = new FilamentTypeUpdateViewModel();

        $userInput->id = $filamentTypeId;
        $userInput->name = $request->string('name', '');
        $userInput->description = $request->string('description', '');
        $userInput->printingTechnologiesIds = $this->convertToIntArray($request->input('printing_technologies', []));
        $userInput->strength = $request->integer('strength', 0);
        $userInput->hardness = $request->integer('hardness', 0);
        $userInput->impactResistance = $request->integer('impact_resistance', 0);
        $userInput->durability = $request->integer('durability', 0);
        $userInput->minWorkTemperature = $request->integer('min_work_temperature', 0);
        $userInput->maxWorkTemperature = $request->integer('max_work_temperature', 0);
        $userInput->food_contact_allowed = $request->boolean('food_contact_allowed', false);

        return $userInput;
    }

    /**
     * Tries to update a filament type
     */
    public function updateFilamentType(Request $request, int $filamentTypeId) : RedirectResponse
    {
        dd($this->getUserInput($request, $filamentTypeId));
        // ...
        return redirect()->route('filament-types');
    }
}
