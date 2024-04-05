<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use App\DTOs\Admin\AdditionalServiceDTO;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdditionalServicesUpdateController
{
    public function showUpdatingForm(int $additionalServiceId) : View
    {
        // ...
        $testData = new AdditionalServiceDTO(1, 'name2', 'description2', '');
        $testData->setPreviewImageUrl('/assets/images/test.gif');
        return view('admin.additional-services.update', ['additionalService' => $testData]);
    }

    public function updateAdditionalService(int $additionalServiceId) : RedirectResponse
    {
        // ...
        return redirect()->back()
                         ->withInput();
    }
}
