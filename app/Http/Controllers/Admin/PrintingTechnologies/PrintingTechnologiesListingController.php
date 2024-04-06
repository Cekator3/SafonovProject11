<?php

namespace App\Http\Controllers\Admin\PrintingTechnologies;

use Illuminate\View\View;

class PrintingTechnologiesListingController
{
    public function showPrintingTechnologies() : View
    {
        // ...
        return view('admin.printing-technologies.list');
    }
}
