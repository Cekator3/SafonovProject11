<?php

namespace App\Http\Controllers\Orders\OrderedModels;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use App\Enums\HttpResponseStatus;
use Illuminate\Http\RedirectResponse;
use App\ViewModels\Orders\OrderedCatalogModelViewModel;
use App\DTOs\Admin\FilamentTypes\FilamentTypeCharacteristics;
use App\DTOs\Orders\NewOrderedCatalogModel\ColorWithPriceDTO;
use App\Services\Orders\OrderedModels\OrderedModelGetterService;
use App\DTOs\Orders\NewOrderedCatalogModel\ModelSizeWithPriceDTO;
use App\DTOs\Orders\NewOrderedCatalogModel\FilamentTypeWithPriceDTO;
use App\DTOs\Orders\NewOrderedCatalogModel\NewOrderedCatalogModelDTO;
use App\Services\Orders\OrderedModels\OrderedCatalogModelAdderService;
use App\DTOs\Orders\NewOrderedCatalogModel\AdditionalServiceWithPriceDTO;
use App\DTOs\Orders\NewOrderedCatalogModel\PrintingTechnologyWithPriceDTO;

class OrderedCatalogModelAdderController
{
    /**
     * @return AdditionalServiceWithPriceDTO[]
     */
    private function getAdditionalServices(int $amount) : array
    {
        $result = [];

        for ($i = 0; $i < $amount; $i++)
        {
            $id = $i;
            $name = fake()->name();
            $description = fake()->paragraph();
            $previewImage = '/assets/images/test.gif';
            $price = fake()->randomFloat(2, 0, 10000);

            $result []= new AdditionalServiceWithPriceDTO($id, $name, $description, $previewImage, $price);
        }

        return $result;
    }

    /**
     * @return ModelSizeWithPriceDTO[]
     */
    private function getModelSizes(int $amount) : array
    {
        $result = [];

        for ($i = 0; $i < $amount; $i++)
        {
            $id = $i;
            $sizeMultiplier = fake()->numberBetween(50, 100);
            $length = fake()->numberBetween(50, 100);
            $width = fake()->numberBetween(50, 100);
            $height = fake()->numberBetween(50, 100);
            $price = fake()->randomFloat(2, 0, 10000);

            $result []= new ModelSizeWithPriceDTO($id, $sizeMultiplier, $length, $width, $height, $price);
        }

        return $result;
    }

    /**
     * @return ColorWithPriceDTO[]
     */
    private function getColors(int $amount) : array
    {
        $result = [];

        for ($i = 0; $i < $amount; $i++)
        {
            $id = $i;
            $code = join('', fake()->rgbColorAsArray());
            $price = fake()->randomFloat(2, 0, 10000);

            $result []= new ColorWithPriceDTO($id, $code, $price);
        }

        return $result;
    }

    /**
     * @return FilamentTypeWithPriceDTO[]
     */
    private function getFilamentTypes(int $amount) : array
    {
        $result = [];

        for ($i = 0; $i < $amount; $i++)
        {
            $id = $i;
            $name = fake()->name();
            $description = fake()->paragraph();
            $characteristics = new FilamentTypeCharacteristics(1, 2, 3, 4, 5, 6, true);
            $price = fake()->randomFloat(2, 0, 10000);

            $result []= new FilamentTypeWithPriceDTO($id, $name, $description, $characteristics, $price);
        }

        return $result;
    }

    /**
     * @return PrintingTechnologyWithPriceDTO[]
     */
    private function getPrintingTechnologies(int $amount) : array
    {
        $result = [];

        for ($i = 0; $i < $amount; $i++)
        {
            $id = $i;
            $name = fake()->name();
            $description = fake()->paragraph();
            $price = fake()->randomFloat(2, 0, 10000);
            $supportedFilamentTypes = range(0, $amount);

            $result []= new PrintingTechnologyWithPriceDTO($id, $name, $description, $supportedFilamentTypes, $price);
        }

        return $result;
    }

    private function getTestData() : NewOrderedCatalogModelDTO
    {
        $amount = 5;
        return new NewOrderedCatalogModelDTO(1,
                                             fake()->name(),
                                             $this->getPrintingTechnologies($amount),
                                             $this->getFilamentTypes($amount),
                                             $this->getColors($amount),
                                             $this->getModelSizes($amount),
                                             $this->getAdditionalServices($amount),
                                             11,
                                             12,
                                             13,
                                             14
        );
    }

    /**
     * Displays the form to add a model from the catalog to the user's shopping cart.
     */
    public function showAddCatalogModelToCartForm(Request $request, int $baseModelId) : View
    {
        // $models = new OrderedModelGetterService();
        // $model = $models->getOnlyCatalogPrices($baseModelId);
        $model = $this->getTestData();

        if ($model === null)
            return abort(HttpResponseStatus::NotFound->value);

        return view('orders.ordering-models.catalog', ['model' => $model]);
    }

    public function getUserInput(Request $request, int $baseModelId) : OrderedCatalogModelViewModel
    {
        $model = new OrderedCatalogModelViewModel();
        // ...
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
