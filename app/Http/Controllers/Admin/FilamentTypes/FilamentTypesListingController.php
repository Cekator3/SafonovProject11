<?php

namespace App\Http\Controllers\Admin\FilamentTypes;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\Admin\FilamentTypes\FilamentTypesGetterService;

class FilamentTypesListingController
{
    public function showFilamentTypes(Request $request) : View
    {
        $searchQuery = $request->query('search', '');
        $filamentTypes = new FilamentTypesGetterService();

        // Apply the search query if exists
        $result = [];
        if ($searchQuery === '')
            $result = $filamentTypes->getAll();
        else
            $result = $filamentTypes->find($searchQuery);

        return view('admin.filament-types.list', ['filamentTypes' => $result]);
    }
}
