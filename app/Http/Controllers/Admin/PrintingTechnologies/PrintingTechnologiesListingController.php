<?php

namespace App\Http\Controllers\Admin\PrintingTechnologies;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\Admin\PrintingTechnologies\PrintingTechnologiesGetterService;

class PrintingTechnologiesListingController
{
    public function showPrintingTechnologies(Request $request) : View
    {
        $searchQuery = $request->query('search', '');
        $printingTechnologies = new PrintingTechnologiesGetterService();

        // Apply the search query if exists
        $result = [];
        if ($searchQuery === '')
            $result = $printingTechnologies->getAll();
        else
            $result = $printingTechnologies->find($searchQuery);

        return view('admin.printing-technologies.list',
                    ['printingTechnologies' => $result]);
    }
}
