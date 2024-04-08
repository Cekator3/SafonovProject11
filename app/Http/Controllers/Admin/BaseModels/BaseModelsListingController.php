<?php

namespace App\Http\Controllers\Admin\BaseModels;

use Illuminate\View\View;
use Illuminate\Http\Request;

class BaseModelsListingController
{
    public function showBaseModels(Request $request) : View
    {
        // ...
        return view('admin.base-models.list');
    }
}
