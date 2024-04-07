<?php

namespace App\Http\Controllers\Admin\FilamentTypes;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use App\Enums\HttpResponseStatus;
use Illuminate\Http\RedirectResponse;
use App\Services\Admin\FilamentTypes\FilamentTypesGetterService;
use App\Services\Admin\FilamentTypes\FilamentTypesUpdateService;
use App\ViewModels\Admin\FilamentType\FilamentTypeUpdateViewModel;
use App\Services\Admin\PrintingTechnologies\PrintingTechnologiesGetterService;

class FilamentTypeUpdateController
{
    public function showUpdatingForm(int $filamentTypeId) : View
    {
        $printingTechnologies = new PrintingTechnologiesGetterService();
        $filamentTypes = new FilamentTypesGetterService();
        $filamentType = $filamentTypes->get($filamentTypeId);

        if ($filamentType === null)
            abort(HttpResponseStatus::NotFound->value);

        return view('admin.filament-types.update', ['filamentType' => $filamentType, 'printingTechnologies' => $printingTechnologies->getAll()]);
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
        $filamentType = $this->getUserInput($request, $filamentTypeId);
        $filamentTypes = new FilamentTypesUpdateService();
        $errors = new UserInputErrors();

        $filamentTypes->update($filamentType, $errors);

        if ($errors->hasAny()) {
            return redirect()->back()
                             ->withErrors($errors->getAll());
        }

        return redirect()->route('filament-types');
    }
}
