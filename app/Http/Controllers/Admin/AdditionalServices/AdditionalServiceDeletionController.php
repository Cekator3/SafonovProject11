<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use App\Repositories\AdditionalServiceRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdditionalServiceDeletionController
{
    public function deleteAdditionalService(int $additionalServiceId) : RedirectResponse
    {
        $additionalServices = new AdditionalServiceRepository();
        $additionalServices->remove($additionalServiceId);

        return redirect()->route('additional-services');
    }
}
