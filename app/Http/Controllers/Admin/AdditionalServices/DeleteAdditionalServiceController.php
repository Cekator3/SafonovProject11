<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use Symfony\Component\HttpFoundation\RedirectResponse;

class DeleteAdditionalServiceController
{
    public function deleteAdditionalService() : RedirectResponse
    {
        // ...
        return redirect()->route('additional-services');
    }
}
