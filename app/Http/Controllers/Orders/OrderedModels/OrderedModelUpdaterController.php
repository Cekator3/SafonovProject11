<?php

namespace App\Http\Controllers\Orders\OrderedModels;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use App\Enums\HttpResponseStatus;
use Illuminate\Http\RedirectResponse;
use App\ViewModels\Orders\OrderedCatalogModelViewModel;
use App\Services\Orders\OrderedModels\OrderedModelGetterService;
use App\Services\Orders\OrderedModels\OrderedModelUpdateService;

class OrderedModelUpdaterController
{
    /**
     * Displays the form to update the ordered model.
     */
    public function showUpdateModelForm(Request $request, int $orderedModelId) : View
    {
        $models = new OrderedModelGetterService();
        $model = $models->get($orderedModelId);

        if ($model === null)
            return abort(HttpResponseStatus::NotFound->value);

        return view('orders.ordering-models.update', ['model' => $model]);
    }

    public function getUserInput(Request $request, int $orderedModelId) : OrderedCatalogModelViewModel
    {
        $model = new OrderedCatalogModelViewModel();
        $model->amount = 1;
        $model->orderedModelId = $orderedModelId;
        $model->modelSizeId = $request->integer('model-size');
        $model->printingTechnologyId = $request->integer('printing-technology');
        $model->filamentTypeId = $request->integer('filament-type');
        $model->isHoled = $request->string('holedness') == 'holed';
        $model->isParted = $request->string('partedness') == 'parted';
        $model->colorId = $request->integer('color');
        $model->amount = $request->integer('amount');
        $res = [];
        foreach ($request->input('additional-services', []) as $additionalServiceId)
        {
            $res []= (int) $additionalServiceId;
        }
        $model->additionalServices = $res;
        $model->amountInputName = 'amount';
        $model->generalErrorsName = 'blah';
        return $model;
    }

    /**
     * Tries to update details of ordered model.
     */
    public function updateOrderedModel(Request $request, int $orderedModelId) : RedirectResponse
    {
        $model = $this->getUserInput($request, $orderedModelId);
        $errors = new UserInputErrors();

        $models = new OrderedModelUpdateService();
        $models->update($model, $errors);

        if ($errors->hasAny()) {
            return redirect()->back()
                             ->withErrors($errors->getAll())
                             ->withInput();
        }

        return redirect()->route('shopping-cart.list');
    }
}
