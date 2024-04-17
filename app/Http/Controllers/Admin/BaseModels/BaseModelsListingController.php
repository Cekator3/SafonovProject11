<?php

namespace App\Http\Controllers\Admin\BaseModels;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\Admin\BaseModels\BaseModelsGetterService;

class BaseModelsListingController
{
    public function showBaseModels(Request $request) : View
    {
        $searchQuery = $request->query('search', '');
        $models = new BaseModelsGetterService();

        // Apply the search query if exists
        $result = [];
        if ($searchQuery === '')
            $result = $models->getAll();
        else
            $result = $models->find($searchQuery);

        return view('admin.base-models.list',
                    ['baseModels' => $result]);
    }
}
