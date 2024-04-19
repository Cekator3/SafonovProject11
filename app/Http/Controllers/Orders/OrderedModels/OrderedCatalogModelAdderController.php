<?php

namespace App\Http\Controllers\Orders\OrderedModels;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use App\Enums\HttpResponseStatus;
use Illuminate\Http\RedirectResponse;
use App\ViewModels\Orders\OrderedCatalogModelViewModel;
use App\Services\Orders\OrderedModels\OrderedModelGetterService;
use App\Services\Orders\OrderedModels\OrderedCatalogModelAdderService;

class OrderedCatalogModelAdderController
{

    /**
     * Displays the form to add a model from the catalog to the user's shopping cart.
     */
    public function showAddCatalogModelToCartForm(Request $request, int $baseModelId) : View
    {
        $models = new OrderedModelGetterService();
        $model = $models->getOnlyCatalogPrices($baseModelId);

        if ($model === null)
            return abort(HttpResponseStatus::NotFound->value);

        return view('orders.ordering-models.catalog', ['model' => $model]);
    }

    public function getUserInput(Request $request, int $baseModelId) : OrderedCatalogModelViewModel
    {
        $model = new OrderedCatalogModelViewModel();
        $model->amount = 1;
        $model->modelId = $baseModelId;
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
     * Tries to add a catalog model to the user's order.
     */
    public function addCatalogModelToOrder(Request $request, int $baseModelId) : RedirectResponse
    {
        $model = $this->getUserInput($request, $baseModelId);
        $errors = new UserInputErrors();

        $models = new OrderedCatalogModelAdderService();
        $models->add($model, $errors);

        if ($errors->hasAny()) {
            return redirect()->back()
                             ->withErrors($errors->getAll())
                             ->withInput();
        }

        return redirect()->route('catalog.item', ['baseModelId' => $baseModelId]);
    }
}
