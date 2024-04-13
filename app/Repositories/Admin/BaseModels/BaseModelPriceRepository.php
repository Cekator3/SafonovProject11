<?php

namespace App\Repositories\Admin\BaseModels;

use Illuminate\Support\Facades\DB;
use App\ViewModels\Admin\BaseModel\Price\ColorPrice;
use App\DTOs\Admin\BaseModels\Prices\ColorWithPriceDTO;
use App\DTOs\Admin\BaseModels\Prices\ModelSizeWithPriceDTO;
use App\ViewModels\Admin\BaseModel\Price\FilamentTypePrice;
use App\DTOs\Admin\BaseModels\Prices\BaseModelPrintPriceDTO;
use App\ViewModels\Admin\BaseModel\Price\BaseModelSizePrice;
use App\DTOs\Admin\BaseModels\Prices\FilamentTypeWithPriceDTO;
use App\ViewModels\Admin\BaseModel\Price\AdditionalServicePrice;
use App\ViewModels\Admin\BaseModel\Price\PrintingTechnologyPrice;
use App\DTOs\Admin\BaseModels\Prices\AdditionalServiceWithPriceDTO;
use App\DTOs\Admin\BaseModels\Prices\PrintingTechnologyWithPriceDTO;
use App\ViewModels\Admin\BaseModel\Price\BaseModelPricesUpdateViewModel;

/**
 * Subsystem for interaction with stored information on base models printing prices
 */
class BaseModelPriceRepository
{
    /**
     * @return PrintingTechnologyWithPriceDTO[]
     */
    private function getPrintingTechnologiesWithPrices(int $baseModelId) : array
    {
        $entries = DB::table('printing_technologies AS pt')
                     ->leftJoinLateral(
                            DB::table('printing_technologies_prices')
                              ->whereColumn('printing_technology_id', '=', 'pt.id')
                              ->where('model_id', '=', $baseModelId)
                              ->select(['price'])
                              ->limit(1)
                        , 'p')
                     ->select(['pt.id AS id', 'pt.name AS name', 'pt.description AS description', 'p.price AS price'])
                     ->get();

        $result = [];
        foreach ($entries as $entry)
        {
            $id = $entry->id;
            $name = $entry->name;
            $description = $entry->description;
            $price = $entry->price ?? 0.0;

            $result []= new PrintingTechnologyWithPriceDTO($id, $name, $description, $price);
        }
        return $result;
    }

    /**
     * @return FilamentTypeWithPriceDTO[]
     */
    private function getFilamentTypesWithPrices(int $baseModelId) : array
    {
        $entries = DB::table('filament_types AS ft')
                     ->leftJoinLateral(
                            DB::table('filament_types_prices')
                              ->whereColumn('filament_type_id', '=', 'ft.id')
                              ->where('model_id', '=', $baseModelId)
                              ->select(['price'])
                              ->limit(1)
                        , 'p')
                     ->select(['ft.id AS id', 'ft.name AS name', 'ft.description AS description', 'p.price AS price'])
                     ->get();

        $result = [];
        foreach ($entries as $entry)
        {
            $id = $entry->id;
            $name = $entry->name;
            $description = $entry->description;
            $price = $entry->price ?? 0.0;

            $result []= new FilamentTypeWithPriceDTO($id, $name, $description, $price);
        }
        return $result;
    }

    /**
     * Returns all colors with their price for base models (if exists).
     * @return ColorWithPriceDTO[]
     */
    private function getColorsWithPrices(int $baseModelId) : array
    {

        $entries = DB::table('colors AS c')
                     ->leftJoinLateral(
                            DB::table('colors_prices')
                              ->whereColumn('color_id', '=', 'c.id')
                              ->where('model_id', '=', $baseModelId)
                              ->select(['price'])
                              ->limit(1)
                        , 'p')
                     ->select(['c.id AS id', 'c.code AS code', 'p.price AS price'])
                     ->get();

        $result = [];
        foreach ($entries as $entry)
        {
            $id = $entry->id;
            $code = $entry->code;
            $price = $entry->price ?? 0.0;

            $result []= new ColorWithPriceDTO($id, $code, $price);
        }
        return $result;
    }

    /**
     * @return ModelSizeWithPriceDTO[]
     */
    private function getModelSizesWithPrices(int $baseModelId) : array
    {
        $entries = DB::table('models_sizes AS s')
                     ->where('s.model_id', '=', $baseModelId)
                     ->select(['s.id AS id', 's.size_multiplier AS size_multiplier', 's.length AS length', 's.width AS width', 's.height AS height', 's.price AS price'])
                     ->get();

        $result = [];
        foreach ($entries as $entry)
        {
            $id = $entry->id;
            $multiplier = $entry->size_multiplier;
            $length = $entry->length;
            $width = $entry->width;
            $height = $entry->height;
            $price = $entry->price ?? 0.0;

            $result []= new ModelSizeWithPriceDTO($id, $multiplier, $length, $width, $height, $price);
        }
        return $result;
    }

    /**
     * @return AdditionalServiceWithPriceDTO[]
     */
    private function getAdditionalServicesWithPrices(int $baseModelId) : array
    {
        $entries = DB::table('additional_services AS s')
                     ->leftJoinLateral(
                            DB::table('additional_services_prices')
                              ->whereColumn('additional_service_id', '=', 's.id')
                              ->where('model_id', '=', $baseModelId)
                              ->select(['price'])
                              ->limit(1)
                        , 'p')
                     ->select(['s.id AS id', 's.name AS name', 's.description AS description', 's.preview_image AS preview_image', 'p.price AS price'])
                     ->get();

        $result = [];
        foreach ($entries as $entry)
        {
            $id = $entry->id;
            $name = $entry->name;
            $description = $entry->description;
            $previewImage = $entry->preview_image;
            $price = $entry->price ?? 0.0;

            $result []= new AdditionalServiceWithPriceDTO($id, $name, $description, $previewImage, $price);
        }
        return $result;
    }

    /**
     * Returns base model's printing price.
     */
    public function get(int $baseModelId) : BaseModelPrintPriceDTO|null
    {
        $entry = DB::table('models')->find($baseModelId, ['price_holed', 'price_solid', 'price_parted', 'price_not_parted']);

        $printingTechnologies = $this->getPrintingTechnologiesWithPrices($baseModelId);
        $filamentTypes = $this->getFilamentTypesWithPrices($baseModelId);
        $colors = $this->getColorsWithPrices($baseModelId);
        $modelSizes = $this->getModelSizesWithPrices($baseModelId);
        $additionalServices = $this->getAdditionalServicesWithPrices($baseModelId);
        return new BaseModelPrintPriceDTO($baseModelId,
                                          $printingTechnologies,
                                          $filamentTypes,
                                          $colors,
                                          $modelSizes,
                                          $additionalServices,
                                          $entry->price_holed ?? 0.0,
                                          $entry->price_solid ?? 0.0,
                                          $entry->price_parted ?? 0.0,
                                          $entry->price_not_parted ?? 0.0);
    }

    /**
     * Checks if base model have printing price
     *
     * @param int $id Identifier of the base model
     */
    public function isExist(int $id) : bool
    {
        // ...
    }

    /**
     * @param AdditionalServicePrice[] $additionalServices
     */
    private function updateAdditionalServicesPrices(int $baseModelId, array $additionalServices) : void
    {
        foreach ($additionalServices as $additionalService)
        {
            $conditions = [
                'additional_service_id' => $additionalService->id,
                'model_id' => $baseModelId
            ];
            $values = ['price' => $additionalService->price];

            DB::table('additional_services_prices')
                    ->updateOrInsert($conditions, $values);
        }
    }

    /**
     * @param PrintingTechnologyPrice[] $printingTechnologies
     */
    private function updatePrintingTechnologiesPrices(int $baseModelId, array $printingTechnologies) : void
    {
        foreach ($printingTechnologies as $printingTechnology)
        {
            $conditions = [
                'printing_technology_id' => $printingTechnology->id,
                'model_id' => $baseModelId
            ];
            $values = ['price' => $printingTechnology->price];

            DB::table('printing_technologies_prices')
                    ->updateOrInsert($conditions, $values);
        }
    }

    /**
     * @param FilamentTypePrice[] $filamentTypes
     */
    private function updateFilamentTypesPrices(int $baseModelId, array $filamentTypes) : void
    {
        foreach ($filamentTypes as $filamentType)
        {
            $conditions = [
                'filament_type_id' => $filamentType->id,
                'model_id' => $baseModelId
            ];
            $values = ['price' => $filamentType->price];

            DB::table('filament_types_prices')
                    ->updateOrInsert($conditions, $values);
        }
    }

    /**
     * @param ColorPrice[] $colors
     */
    private function updateColorsPrices(int $baseModelId, array $colors) : void
    {
        foreach ($colors as $color)
        {
            $conditions = [
                'color_id' => $color->id,
                'model_id' => $baseModelId
            ];
            $values = ['price' => $color->price];

            DB::table('colors_prices')
                    ->updateOrInsert($conditions, $values);
        }
    }

    /**
     * @param BaseModelSizePrice[] $sizes
     */
    private function updateModelSizesPrices(int $baseModelId, array $sizes) : void
    {
        foreach ($sizes as $size)
        {
            DB::table('models_sizes')
                    ->where('id', '=', $size->id)
                    ->where('model_id', '=', $baseModelId)
                    ->update(['price' => $size->price]);
        }
    }

    /**
     * Updates printing price of base model.
     *
     * @param BaseModelPricesUpdateViewModel $model New base model's printing price data.
     */
    public function update(BaseModelPricesUpdateViewModel $model) : void
    {
        // Update prices for various types
        DB::table('models')->where('id', '=', $model->id)->update([
            'price_holed' => $model->priceForHoledType,
            'price_solid' => $model->priceForSolidType,
            'price_parted' => $model->priceForPartedType,
            'price_not_parted' => $model->priceForNotPartedType
        ]);

        $this->updateAdditionalServicesPrices($model->id, $model->additionalServicesPrices);
        $this->updatePrintingTechnologiesPrices($model->id, $model->printingTechnologiesPrices);
        $this->updateFilamentTypesPrices($model->id, $model->filamentTypesPrices);
        $this->updateColorsPrices($model->id, $model->colorsPrices);
        $this->updateModelSizesPrices($model->id, $model->modelSizesPrices);
    }
}
