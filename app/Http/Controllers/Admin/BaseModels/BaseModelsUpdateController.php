<?php

namespace App\Http\Controllers\Admin\BaseModels;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\DTOs\Admin\BaseModels\BaseModelDTO;
use App\DTOs\Admin\BaseModels\ModelSizeDTO;
use App\ViewModels\Admin\BaseModel\BaseModelSize;
use App\DTOs\Admin\BaseModels\ModelGalleryImageDTO;
use App\ViewModels\Admin\BaseModel\BaseModelUpdateViewModel;

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

    private function getTestData() : BaseModelDTO
    {
        $galleryImages = $this->getTestGalleryImages(15);
        $modelSizes = $this->getTestModelSizes(15);
        $model = new BaseModelDTO(0, fake()->userName(), fake()->text(), '', $galleryImages, $modelSizes);
        $model->setPreviewImageUrl('/assets/images/test.gif');

        return $model;
    }

    public function showUpdatingForm(int $baseModelId) : View
    {
        $model = $this->getTestData();
        return view('admin.base-models.update', ['model' => $model]);
    }

    /**
     * @return BaseModelSize[]
     */
    private function getModelSizesFromUserInput(Request $request) : array
    {
        $result = [];

        $inputs = $request->input('model-sizes', []);
        foreach ($inputs as $input)
        {
            $size = new BaseModelSize();

            $size->multiplier = $input['multiplier'];
            $size->length = $input['length'];
            $size->width = $input['width'];
            $size->height = $input['height'];

            $result []= $size;
        }

        return $result;
    }

    /**
     * @return int[] Identifiers of removed gallery images
     */
    private function getRemovedGalleryImagesFromUserInput(Request $request) : array
    {
        $result = [];

        $inputs = $request->input('removed-gallery-images');
        foreach ($inputs as $input)
        {
            $id = intval($input);
            if ($id === 0)
                continue;
            $result []= $id;
        }

        return $result;
    }

    private function getUserInput(Request $request, int $baseModelId) : BaseModelUpdateViewModel
    {
        $model = new BaseModelUpdateViewModel();

        $model->id = $baseModelId;
        $model->name = $request->string('name', '');
        $model->description = $request->string('description', '');
        $model->modelSizes = $this->getModelSizesFromUserInput($request);
        $model->thumbnail = $request->file('previewImage');
        $model->newGalleryImages = $request->file('galleryImages');
        $model->removedGalleryImages = $this->getRemovedGalleryImagesFromUserInput($request);

        return $model;
    }

    /**
     * Tries to update a base model
     */
    public function updateBaseModel(Request $request, int $baseModelId) : RedirectResponse
    {
        dd($request->input(), $this->getUserInput($request));
        // ...
        return redirect()->route('base-models');
    }
}
