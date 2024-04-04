<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use Illuminate\View\View;

class ListAdditionalServicesController
{
    private function getTestData() : array
    {
        
    }

    public function showAdditionalServices() : View
    {
        // ...
        return view('admin.additional-services.list');
    }
}
