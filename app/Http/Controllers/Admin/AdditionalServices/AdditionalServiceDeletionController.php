<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Services\Admin\AdditionalServices\AdditionalServicesDeletionService;

class AdditionalServiceDeletionController
{
    public function deleteAdditionalService(int $additionalServiceId) : RedirectResponse
    {
        $additionalServices = new AdditionalServicesDeletionService();
        $additionalServices->remove($additionalServiceId);

        return redirect()->route('additional-services');
    }
}
