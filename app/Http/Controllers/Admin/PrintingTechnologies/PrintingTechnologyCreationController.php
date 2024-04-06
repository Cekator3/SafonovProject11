<?php

namespace App\Http\Controllers\Admin\PrintingTechnologies;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use Illuminate\Http\RedirectResponse;
use App\Services\Admin\PrintingTechnologies\PrintingTechnologiesCreationService;
use App\ViewModels\Admin\PrintingTechnology\PrintingTechnologyCreationViewModel;

class PrintingTechnologyCreationController
{
    public function showCreationForm() : View
    {
        return view('admin.printing-technologies.create');
    }

    private function getUserInput(Request $request) : PrintingTechnologyCreationViewModel
    {
        $userInput = new PrintingTechnologyCreationViewModel();
        $userInput->name = $request->string('name', '');
        $userInput->description = $request->string('description', '');
        return $userInput;
    }

    /**
     * Tries to create a new printing technology
     *
     * @param Request $request User's input
     */
    public function createPrintingTechnology(Request $request) : RedirectResponse
    {
        $printingTechnology = $this->getUserInput($request);
        $printingTechnologies = new PrintingTechnologiesCreationService();
        $errors = new UserInputErrors();

        $printingTechnologies->add($printingTechnology, $errors);

        if ($errors->hasAny()) {
            return redirect()->back()
                             ->withErrors($errors->getAll())
                             ->withInput();
        }

        return redirect()->route('printing-technologies');
    }
}
