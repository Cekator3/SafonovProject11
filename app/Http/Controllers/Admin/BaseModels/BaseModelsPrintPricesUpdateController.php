<?php

namespace App\Http\Controllers\Admin\BaseModels;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use Illuminate\Http\RedirectResponse;
use App\ViewModels\Admin\BaseModel\Price\ColorPrice;
use App\DTOs\Admin\BaseModels\Prices\ColorWithPriceDTO;
use App\DTOs\Admin\BaseModels\Prices\ModelSizeWithPriceDTO;
use App\ViewModels\Admin\BaseModel\Price\FilamentTypePrice;
use App\DTOs\Admin\BaseModels\Prices\BaseModelPrintPriceDTO;
use App\ViewModels\Admin\BaseModel\Price\BaseModelSizePrice;
use App\DTOs\Admin\BaseModels\Prices\FilamentTypeWithPriceDTO;
use App\Services\Admin\BaseModels\BaseModelsPriceUpdateService;
use App\ViewModels\Admin\BaseModel\Price\AdditionalServicePrice;
use App\ViewModels\Admin\BaseModel\Price\PrintingTechnologyPrice;
use App\DTOs\Admin\BaseModels\Prices\AdditionalServiceWithPriceDTO;
use App\DTOs\Admin\BaseModels\Prices\PrintingTechnologyWithPriceDTO;
use App\ViewModels\Admin\BaseModel\Price\BaseModelPricesUpdateViewModel;

class BaseModelsPrintPricesUpdateController
{
    /**
     * @return PrintingTechnologyWithPriceDTO[]
     */
    private function getPrintingTechnologies(int $amount) : array
    {
        $result = [];

        for ($i = 0; $i < $amount; $i++)
            $result []= new PrintingTechnologyWithPriceDTO($i, fake()->name(), fake()->text(), fake()->numberBetween(1, 100));

        return $result;
    }

    /**
     * @return FilamentTypeWithPriceDTO[]
     */
    private function getFilamentTypes(int $amount) : array
    {
        $result = [];

        for ($i = 0; $i < $amount; $i++)
            $result []= new FilamentTypeWithPriceDTO($i, fake()->name(), fake()->text(), fake()->numberBetween(100, 1000));

        return $result;
    }

    /**
     * @return ColorWithPriceDTO[]
     */
    private function getColors(int $amount) : array
    {
        $result = [];

        for ($i = 0; $i < $amount; $i++)
            $result []= new ColorWithPriceDTO($i, fake()->rgbCssColor(), fake()->numberBetween(1, 1000));

        return $result;
    }

    /**
     * @return ModelSizeWithPriceDTO[]
     */
    function getModelSizes(int $amount) : array
    {
        $result = [];

        for ($i = 0; $i < $amount; $i++)
            $result []= new ModelSizeWithPriceDTO($i, fake()->randomFloat(2, 1, 200), fake()->numberBetween(100, 1000), fake()->numberBetween(100, 1000), fake()->numberBetween(100, 1000), fake()->numberBetween(100, 10000));

        return $result;
    }

    /**
     * @return AdditionalServiceWithPriceDTO[]
     */
    function getAdditionalServices(int $amount) : array
    {
        $result = [];

        for ($i = 0; $i < $amount; $i++)
        {
            $addService = new AdditionalServiceWithPriceDTO($i, fake()->name(), fake()->text(), '', fake()->numberBetween(100, 1000));
            $addService->setPreviewImageUrl('/assets/images/test.gif');
            $result []= $addService;
        }

        return $result;
    }

    private function getTestData() : BaseModelPrintPriceDTO
    {
        $printingTechnologies = $this->getPrintingTechnologies(15);
        $filamentTypes = $this->getFilamentTypes(15);
        $colors = $this->getColors(15);
        $sizes = $this->getModelSizes(15);
        $additionalServices = $this->getAdditionalServices(15);
        return new BaseModelPrintPriceDTO(0, $printingTechnologies, $filamentTypes, $colors, $sizes, $additionalServices, fake()->numberBetween(100, 1000), fake()->numberBetween(100, 1000), fake()->numberBetween(100, 1000), fake()->numberBetween(100, 1000));
    }

    public function showUpdatingForm(int $baseModelId) : View
    {
        // dd(old());
        return view('admin.base-models.update-prices', ['model' => $this->getTestData()]);
    }

    /**
     * @return PrintingTechnologyPrice[]
     */
    private function getPrintingTechnologiesPrices(Request $request) : array
    {
        $result = [];

        $printingTechnologies = $request->input('prices.printing-technologies');
        for ($i = 0; $i < count($printingTechnologies); $i++)
        {
            $printingTechnology = $printingTechnologies[$i];

            $price = new PrintingTechnologyPrice();
            $price->id = $printingTechnology['id'];
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

        $filamentTypes = $request->input('prices.filament-types');
        for ($i = 0; $i < count($filamentTypes); $i++)
        {
            $filamentType = $filamentTypes[$i];

            $price = new FilamentTypePrice();
            $price->id = $filamentType['id'];
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

        $colors = $request->input('prices.colors');
        for ($i = 0; $i < count($colors); $i++)
        {
            $color = $colors[$i];

            $price = new ColorPrice();
            $price->id = $color['id'];
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

        $sizes = $request->input('prices.model-sizes');
        for ($i = 0; $i < count($sizes); $i++)
        {
            $size = $sizes[$i];

            $price = new BaseModelSizePrice();
            $price->id = $size['id'];
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

        $additionalServices = $request->input('prices.additional-services');
        for ($i = 0; $i < count($additionalServices); $i++)
        {
            $additionalService = $additionalServices[$i];

            $price = new AdditionalServicePrice();
            $price->id = $additionalService['id'];
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
