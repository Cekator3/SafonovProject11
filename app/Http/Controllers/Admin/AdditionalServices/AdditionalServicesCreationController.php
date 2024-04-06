<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use App\Errors\UserInputErrors;
use App\Services\Admin\AdditionalServices\AdditionalServicesCreationService;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\ViewModels\Admin\AdditionalService\AdditionalServiceCreationViewModel;

class AdditionalServicesCreationController
{
    public function showCreationForm() : View
    {
        return view('admin.additional-services.create');
    }

    private function getUserInput(Request $request) : AdditionalServiceCreationViewModel
    {
        $userInput = new AdditionalServiceCreationViewModel();
        $userInput->name = $request->string('name', '');
        $userInput->description = $request->string('description', '');
        $userInput->thumbnailFile = $request->file('previewImage');
        return $userInput;
    }

    /**
     * Tries to create a new additional service
     *
     * @param Request $request User's input
     */
    public function createAdditionalService(Request $request) : RedirectResponse
    {
        $additionalService = $this->getUserInput($request);
        $additionalServices = new AdditionalServicesCreationService();
        $errors = new UserInputErrors();

        $additionalServices->add($additionalService, $errors);

        if ($errors->hasAny()) {
            return redirect()->back()
                             ->withErrors($errors->getAll())
                             ->withInput();
        }

        return redirect()->route('additional-services');
    }
}
