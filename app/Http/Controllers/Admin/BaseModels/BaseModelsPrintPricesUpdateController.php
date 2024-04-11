<?php

namespace App\Http\Controllers\Admin\BaseModels;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\DTOs\Admin\BaseModels\Prices\ColorWithPriceDTO;
use App\DTOs\Admin\BaseModels\Prices\BaseModelPrintPriceDTO;
use App\DTOs\Admin\BaseModels\Prices\ModelSizeWithPriceDTO;
use App\DTOs\Admin\BaseModels\Prices\FilamentTypeWithPriceDTO;
use App\DTOs\Admin\BaseModels\Prices\AdditionalServiceWithPriceDTO;
use App\DTOs\Admin\BaseModels\Prices\PrintingTechnologyWithPriceDTO;

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
        return view('admin.base-models.update-prices', ['model' => $this->getTestData()]);
    }

    /**
     * Tries to update a base model's print price
     */
    public function updateBaseModelPrintPrice(Request $request, int $baseModelId) : RedirectResponse
    {
        dd($request->input());
        // ...
        return redirect()->route('base-models');
    }
}
