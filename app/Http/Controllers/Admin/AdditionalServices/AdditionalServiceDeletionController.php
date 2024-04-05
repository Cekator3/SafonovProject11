<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use Symfony\Component\HttpFoundation\RedirectResponse;

class AdditionalServiceDeletionController
{
    public function deleteAdditionalService(int $additionalServiceId) : RedirectResponse
    {
        // ...
        return redirect()->route('additional-services');
    }
}
