<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use Illuminate\View\View;
use App\DTOs\Admin\AdditionalServiceDTO;

class ListAdditionalServicesController
{
    public function showAdditionalServices() : View
    {
        // ...
        return view('admin.additional-services.list',
                    ['additionalServices' => $this->getTestData()]);
    }
}
