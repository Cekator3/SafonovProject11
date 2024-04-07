<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use App\Enums\HttpResponseStatus;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use Illuminate\Http\RedirectResponse;
use App\Services\Admin\AdditionalServices\AdditionalServicesGetterService;
use App\Services\Admin\AdditionalServices\AdditionalServicesUpdateService;
use App\ViewModels\Admin\AdditionalService\AdditionalServiceUpdateViewModel;

class AdditionalServicesUpdateController
{
    public function showUpdatingForm(int $additionalServiceId) : View
    {
        $additionalServices = new AdditionalServicesGetterService();
        $additionalService = $additionalServices->get($additionalServiceId);

        if ($additionalService === null)
            abort(HttpResponseStatus::NotFound->value);

        return view('admin.additional-services.update', ['additionalService' => $additionalService]);
    }

    private function getUserInput(Request $request, int $additionalServiceId) : AdditionalServiceUpdateViewModel
    {
        $userInput = new AdditionalServiceUpdateViewModel();
        $userInput->id = $additionalServiceId;
        $userInput->name = $request->string('name', '');
        $userInput->description = $request->string('description', '');
        $userInput->thumbnailFile = $request->file('previewImage');
        return $userInput;
    }

    public function updateAdditionalService(Request $request, int $additionalServiceId) : RedirectResponse
    {
        $additionalService = $this->getUserInput($request, $additionalServiceId);
        $additionalServices = new AdditionalServicesUpdateService();
        $errors = new UserInputErrors();

        $additionalServices->update($additionalService, $errors);

        if ($errors->hasAny()) {
            return redirect()->back()
                             ->withErrors($errors->getAll());
        }

        return redirect()->route('additional-services');
    }
}
