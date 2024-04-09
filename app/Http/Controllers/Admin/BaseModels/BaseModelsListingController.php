<?php

namespace App\Http\Controllers\Admin\BaseModels;

use App\DTOs\Admin\BaseModels\ModelItemListDTO;
use Illuminate\View\View;
use Illuminate\Http\Request;

class BaseModelsListingController
{
    private function getTestData(int $amount) : array
    {
        $result = [];

        for ($i = 0; $i < $amount; $i++)
        {
            $model = new ModelItemListDTO($i, "test{$i}", '');
            $model->setPreviewImageUrl('/assets/images/test.gif');
            $result []= $model;
        }

        return $result;
    }

    public function showBaseModels(Request $request) : View
    {
        // ...
        return view('admin.base-models.list', ['baseModels' => $this->getTestData(20)]);
    }
}
