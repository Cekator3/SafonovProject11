<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class UpdateAdditionalServicesController extends Controller
{
    public function showUpdatingForm(int $id) : View
    {
        // ...
    }

    public function updateAdditionalService(int $id) : RedirectResponse
    {
        // ...
        return redirect()->route('additional-services');
    }
}
