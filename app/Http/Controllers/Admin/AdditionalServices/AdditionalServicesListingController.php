<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use App\Services\Admin\AdditionalServices\AdditionalServicesGetterService;
use Illuminate\View\View;

class AdditionalServicesListingController
{
    public function showAdditionalServices() : View
    {
        $additionalServices = new AdditionalServicesGetterService();

        return view('admin.additional-services.list',
                    ['additionalServices' => $additionalServices->getAll()]);
    }
}
