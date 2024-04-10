<?php

namespace App\Http\Controllers\Admin\BaseModels;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\DTOs\Admin\BaseModels\ModelDTO;
use App\DTOs\Admin\BaseModels\ModelSizeDTO;
use App\DTOs\Admin\BaseModels\ModelGalleryImageDTO;

class BaseModelsUpdateController
{
    /**
     * @return ModelGalleryImageDTO[]
     */
    private function getTestGalleryImages(int $amount) : array
    {
        $result = [];

        for ($i = 0; $i < $amount; $i++)
        {
            $galleryImage = new ModelGalleryImageDTO($i, '');
            $galleryImage->setUrl('/assets/images/test.gif');

            $result []= $galleryImage;
        }

        return $result;
    }

    /**
     * @return ModelSizeDTO[]
     */
    private function getTestModelSizes(int $amount) : array
    {
        $result = [];

        for ($i = 0; $i < $amount; $i++)
            $result []= new ModelSizeDTO($i, fake()->randomNumber(3, true), fake()->randomNumber(3, true), fake()->randomNumber(3, true), fake()->randomNumber(3, true));

        return $result;
    }

    private function getTestData() : ModelDTO
    {
        $galleryImages = $this->getTestGalleryImages(15);
        $modelSizes = $this->getTestModelSizes(15);
        $model = new ModelDTO(0, fake()->userName(), fake()->text(), '', $galleryImages, $modelSizes);
        $model->setPreviewImageUrl('/assets/images/test.gif');

        return $model;
    }

    public function showUpdatingForm(int $baseModelId) : View
    {
        $model = $this->getTestData();
        return view('admin.base-models.update', ['model' => $model]);
    }

    /**
     * Tries to update a base model
     */
    public function updateBaseModel(Request $request, int $baseModelId) : RedirectResponse
    {
        dd($request->input());
        // ...
        return redirect()->route('base-models');
    }
}
