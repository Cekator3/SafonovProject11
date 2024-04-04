<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use Illuminate\View\View;

class ListAdditionalServicesController
{
    public function showAdditionalServices() : View
    {
        // ...
        return view('admin.additional-services.list');
    }
}
