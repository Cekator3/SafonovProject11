<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DeleteAdditionalServiceController extends Controller
{
    public function deleteAdditionalService() : RedirectResponse
    {
        // ...
        return redirect()->route('additional-services');
    }
}
