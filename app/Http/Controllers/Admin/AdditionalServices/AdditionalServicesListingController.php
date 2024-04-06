<?php

namespace App\Http\Controllers\Admin\AdditionalServices;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\Admin\AdditionalServices\AdditionalServicesGetterService;

class AdditionalServicesListingController
{
    public function showAdditionalServices(Request $request) : View
    {
        $searchQuery = $request->query('search', '');
        $additionalServices = new AdditionalServicesGetterService();

        // Apply the search query if exists
        $result = [];
        if ($searchQuery === '')
            $result = $additionalServices->getAll();
        else
            $result = $additionalServices->find($searchQuery);

        return view('admin.additional-services.list',
                    ['additionalServices' => $result]);
    }
}
