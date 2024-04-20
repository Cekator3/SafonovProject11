<?php

namespace App\Http\Controllers\Admin\BaseModels;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use Illuminate\Http\RedirectResponse;
use App\ViewModels\Admin\BaseModel\BaseModelSize;
use App\Services\Admin\BaseModels\BaseModelsCreationService;
use App\ViewModels\Admin\BaseModel\BaseModelCreationViewModel;

class BaseModelsCreationController
{
    public function showCreationForm() : View
    {
        // ...
        return view('admin.base-models.create');
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

    private function getUserInput(Request $request) : BaseModelCreationViewModel
    {
        $model = new BaseModelCreationViewModel();

        $model->name = $request->string('name', '');
        $model->description = $request->string('description', '');
        $model->modelSizes = $this->getModelSizesFromUserInput($request);
        $model->thumbnail = $request->file('previewImage');
        $model->galleryImages = $request->file('galleryImages');

        $model->nameInputName = 'name';
        $model->descriptionInputName = 'description';
        $model->thumbnailInputName = 'previewImage';
        $model->galleryImagesInputName = 'galleryImages[]';

        return $model;
    }

    /**
     * Tries to create a new base model
     *
     * @param Request $request User's input
     */
    public function createBaseModel(Request $request) : RedirectResponse
    {
        $models = new BaseModelsCreationService();
        $model = $this->getUserInput($request);
        $errors = new UserInputErrors();

        $models->add($model, $errors);

        if ($errors->hasAny()) {
            return redirect()->back()
                             ->withErrors($errors->getAll())
                             ->withInput();
        }

        return redirect()->route('base-models.update-prices');
    }
}
