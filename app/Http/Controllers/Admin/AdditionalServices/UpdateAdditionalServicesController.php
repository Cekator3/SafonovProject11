<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UpdateAdditionalServicesController
{
    public function showUpdatingForm(int $additionalServiceId) : View
    {
        // ...
        return view('admin.additional-services.update');
    }

    public function updateAdditionalService(int $additionalServiceId) : RedirectResponse
    {
        // ...
        return redirect()->route('additional-services');
    }
}
