<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CreateAdditionalServicesController
{
    public function showCreationForm() : View
    {
        return view('admin.additional-services.create');
    }

    public function createAdditionalService() : RedirectResponse
    {
        // ...
        return redirect()->route('additional-services');
    }
}
