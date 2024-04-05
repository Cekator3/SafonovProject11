<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use App\Repositories\AdditionalServiceRepository;
use Illuminate\View\View;

class ListAdditionalServicesController
{
    public function showAdditionalServices() : View
    {
        $additionalServices = new AdditionalServiceRepository();

        return view('admin.additional-services.list',
                    ['additionalServices' => $additionalServices->getAll()]);
    }
}
