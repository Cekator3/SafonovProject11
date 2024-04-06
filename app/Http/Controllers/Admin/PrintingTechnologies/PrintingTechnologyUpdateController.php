<?php

namespace App\Http\Controllers\Admin\PrintingTechnologies;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use Illuminate\Http\RedirectResponse;
use App\Services\Admin\PrintingTechnologies\PrintingTechnologiesGetterService;
use App\Services\Admin\PrintingTechnologies\PrintingTechnologiesUpdateService;
use App\ViewModels\Admin\PrintingTechnology\PrintingTechnologyUpdateViewModel;

class PrintingTechnologyUpdateController
{
    public function showUpdatingForm(int $printingTechnologyId) : View
    {
        $printingTechnologies = new PrintingTechnologiesGetterService();
        $printingTechnology = $printingTechnologies->get($printingTechnologyId);

        return view('admin.printing-technologies.update', ['printingTechnology' => $printingTechnology]);
    }

    private function getUserInput(Request $request, int $printingTechnologyId) : PrintingTechnologyUpdateViewModel
    {
        $userInput = new PrintingTechnologyUpdateViewModel();
        $userInput->id = $printingTechnologyId;
        $userInput->name = $request->string('name', '');
        $userInput->description = $request->string('description', '');
        return $userInput;
    }

    /**
     * Tries to update a printing technology
     */
    public function updatePrintingTechnology(Request $request, int $printingTechnologyId) : RedirectResponse
    {
        $printingTechnology = $this->getUserInput($request, $printingTechnologyId);
        $printingTechnologies = new PrintingTechnologiesUpdateService();
        $errors = new UserInputErrors();

        $printingTechnologies->update($printingTechnology, $errors);

        if ($errors->hasAny()) {
            return redirect()->back()
                             ->withErrors($errors->getAll());
        }

        return redirect()->route('printing-technologies');
    }
}
