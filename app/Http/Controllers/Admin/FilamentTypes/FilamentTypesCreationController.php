<?php

namespace App\Http\Controllers\Admin\FilamentTypes;

use App\Errors\UserInputErrors;
use App\Repositories\Admin\PrintingTechnologyRepository;
use App\Services\Admin\FilamentTypes\FilamentTypesCreationService;
use App\ViewModels\Admin\FilamentType\FilamentTypeCreationViewModel;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\DTOs\Admin\PrintingTechnologies\PrintingTechnologyNameOnlyDTO;

class FilamentTypesCreationController
{
    public function showCreationForm() : View
    {
        $printingTechnologies = new PrintingTechnologyRepository();
        return view('admin.filament-types.create',
                    ['printingTechnologies' => $printingTechnologies->getAllNamesAndIdentifiers()]);
    }

    private function convertToIntArray(array $stringArr) : array
    {
        return array_map('intval', $stringArr);
    }

    private function getUserInput(Request $request) : FilamentTypeCreationViewModel
    {
        $userInput = new FilamentTypeCreationViewModel();

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
     * Tries to create a new filament type
     *
     * @param Request $request User's input
     */
    public function createFilamentType(Request $request) : RedirectResponse
    {
        $filamentType = $this->getUserInput($request);
        $filamentTypes = new FilamentTypesCreationService();
        $errors = new UserInputErrors();

        $filamentTypes->add($filamentType, $errors);

        if ($errors->hasAny()) {
            return redirect()->back()
                             ->withErrors($errors->getAll())
                             ->withInput();
        }

        return redirect()->route('filament-types');
    }
}
