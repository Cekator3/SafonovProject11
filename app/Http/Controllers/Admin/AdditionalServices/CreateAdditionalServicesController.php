<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class CreateAdditionalServicesController extends Controller
{
    public function showCreationForm() : View
    {
        // ...
    }

    public function createAdditionalService() : RedirectResponse
    {
        // ...
        return redirect()->route('additional-services');
    }
}
