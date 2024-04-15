<?php

namespace App\Http\Controllers\Admin\BaseModels;

use App\Services\Admin\BaseModels\BaseModelsPrintPricesGetterService;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use Illuminate\Http\RedirectResponse;
use App\ViewModels\Admin\BaseModel\Price\ColorPrice;
use App\ViewModels\Admin\BaseModel\Price\FilamentTypePrice;
use App\ViewModels\Admin\BaseModel\Price\BaseModelSizePrice;
use App\Services\Admin\BaseModels\BaseModelsPriceUpdateService;
use App\ViewModels\Admin\BaseModel\Price\AdditionalServicePrice;
use App\ViewModels\Admin\BaseModel\Price\PrintingTechnologyPrice;
use App\ViewModels\Admin\BaseModel\Price\BaseModelPricesUpdateViewModel;

class BaseModelsPrintPricesUpdateController
{
    public function showUpdatingForm(int $baseModelId) : View
    {
        $models = new BaseModelsPrintPricesGetterService();
        $model = $models->get($baseModelId);
        return view('admin.base-models.update-prices', ['model' => $model]);
    }

    /**
     * @return PrintingTechnologyPrice[]
     */
    private function getPrintingTechnologiesPrices(Request $request) : array
    {
        $result = [];

        $printingTechnologies = $request->input('prices.printing-technologies', []);
        foreach ($printingTechnologies as $id => $printingTechnology)
        {
            $price = new PrintingTechnologyPrice();
            $price->id = $id;
            $price->price = $printingTechnology['price'];
            $price->inputName = "prices[printing-technologies][$price->id][price]";

            $result []= $price;
        }

        return $result;
    }

    /**
     * @return FilamentTypePrice[]
     */
    private function getFilamentTypesPrices(Request $request) : array
    {
        $result = [];

        $filamentTypes = $request->input('prices.filament-types', []);
        foreach ($filamentTypes as $id => $filamentType)
        {
            $price = new FilamentTypePrice();
            $price->id = $id;
            $price->price = $filamentType['price'];
            $price->inputName = "prices[filament-types][$price->id][price]";

            $result []= $price;
        }

        return $result;
    }

    /**
     * @return ColorPrice[]
     */
    private function getColorsPrices(Request $request) : array
    {
        $result = [];

        $colors = $request->input('prices.colors', []);
        foreach ($colors as $id => $color)
        {
            $price = new ColorPrice();
            $price->id = $id;
            $price->price = $color['price'];
            $price->inputName = "prices[colors][$price->id][price]";

            $result []= $price;
        }

        return $result;
    }

    /**
     * @return BaseModelSizePrice[]
     */
    private function getModelSizesPrices(Request $request) : array
    {
        $result = [];

        $sizes = $request->input('prices.model-sizes', []);
        foreach ($sizes as $id => $size)
        {
            $price = new BaseModelSizePrice();
            $price->id = $id;
            $price->price = $size['price'];
            $price->inputName = "prices[model-sizes][$price->id][price]";

            $result []= $price;
        }

        return $result;
    }

    /**
     * @return AdditionalServicePrice[]
     */
    private function getAdditionalServicesPrices(Request $request) : array
    {
        $result = [];

        $additionalServices = $request->input('prices.additional-services', []);
        foreach ($additionalServices as $id => $additionalService)
        {
            $price = new AdditionalServicePrice();
            $price->id = $id;
            $price->price = $additionalService['price'];
            $price->inputName = "prices[additional-services][$price->id][price]";

            $result []= $price;
        }

        return $result;
    }

    private function getUserInput(Request $request, int $baseModelId) : BaseModelPricesUpdateViewModel
    {
        $model = new BaseModelPricesUpdateViewModel();

        $model->id = $baseModelId;
        $model->printingTechnologiesPrices = $this->getPrintingTechnologiesPrices($request);
        $model->filamentTypesPrices = $this->getFilamentTypesPrices($request);
        $model->colorsPrices = $this->getColorsPrices($request);
        $model->modelSizesPrices = $this->getModelSizesPrices($request);
        $model->additionalServicesPrices = $this->getAdditionalServicesPrices($request);
        $model->priceForSolidType = $request->float('prices.solid');
        $model->priceForHoledType = $request->float('prices.holed');
        $model->priceForPartedType = $request->float('prices.parted');
        $model->priceForNotPartedType = $request->float('prices.not-parted');

        $model->priceForSolidTypeInputName = 'prices[solid]';
        $model->priceForHoledTypeInputName = 'prices[holed]';
        $model->priceForPartedTypeInputName = 'prices[parted]';
        $model->priceForNotPartedTypeInputName = 'prices[not-parted]';

        return $model;
    }

    /**
     * Tries to update a base model's print price
     */
    public function updateBaseModelPrintPrice(Request $request, int $baseModelId) : RedirectResponse
    {
        $models = new BaseModelsPriceUpdateService();
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
