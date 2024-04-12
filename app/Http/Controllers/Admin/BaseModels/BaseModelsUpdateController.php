<?php

namespace App\Http\Controllers\Admin\BaseModels;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use Illuminate\Http\RedirectResponse;
use App\DTOs\Admin\BaseModels\BaseModelDTO;
use App\DTOs\Admin\BaseModels\ModelSizeDTO;
use App\ViewModels\Admin\BaseModel\BaseModelSize;
use App\DTOs\Admin\BaseModels\ModelGalleryImageDTO;
use App\Services\Admin\BaseModels\BaseModelsUpdateService;
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

    private function getInputFromPreviousRequest() : BaseModelDTO|null
    {
        // dd(old());
        return null;
    }

    public function showUpdatingForm(int $baseModelId) : View
    {
        $model = $this->getInputFromPreviousRequest();

        if ($model === null)
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
        for ($i = 0; $i < count($inputs); $i++)
        {
            $input = $inputs[$i];
            $size = new BaseModelSize();

            $size->multiplier = $input['multiplier'];
            $size->length = $input['length'];
            $size->width = $input['width'];
            $size->height = $input['height'];

            $size->multiplierInputName = "model-sizes[$i][multiplier]";
            $size->lengthInputName = "model-sizes[$i][length]";
            $size->widthInputName = "model-sizes[$i][width]";
            $size->heightInputName = "model-sizes[$i][height]";

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

        $inputs = $request->input('removed-gallery-images', []);
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

        $model->nameInputName = 'name';
        $model->descriptionInputName = 'description';
        $model->thumbnailInputName = 'previewImage';
        $model->galleryImagesInputName = 'galleryImages[]';

        return $model;
    }

    /**
     * Tries to update a base model
     */
    public function updateBaseModel(Request $request, int $baseModelId) : RedirectResponse
    {
        $models = new BaseModelsUpdateService();
        $model = $this->getUserInput($request, $baseModelId);
        $errors = new UserInputErrors();

        $models->update($model, $errors);

        if ($errors->hasAny()) {
            return redirect()->back()
                             ->withErrors($errors->getAll())
                             ->withInput();
        }

        return redirect()->route('base-models');
    }
}
