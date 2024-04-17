<?php

namespace App\Repositories\Orders;

use App\DTOs\Admin\FilamentTypes\FilamentTypeCharacteristics;
use Illuminate\Support\Facades\DB;
use App\Errors\Orders\OrderedModelUpdateErrors;
use App\Errors\Orders\OrderModelAdditionErrors;
use App\DTOs\Orders\ShoppingCart\ShoppingCartDTO;
use App\ViewModels\Orders\OrderedCatalogModelViewModel;
use App\DTOs\Orders\NewOrderedCatalogModel\ColorWithPriceDTO;
use App\DTOs\Orders\NewOrderedCatalogModel\ModelSizeWithPriceDTO;
use App\DTOs\Orders\NewOrderedCatalogModel\FilamentTypeWithPriceDTO;
use App\DTOs\Orders\NewOrderedCatalogModel\NewOrderedCatalogModelDTO;
use App\DTOs\Orders\NewOrderedCatalogModel\AdditionalServiceWithPriceDTO;
use App\DTOs\Orders\NewOrderedCatalogModel\PrintingTechnologyWithPriceDTO;
use App\DTOs\Orders\ExistingOrderedCatalogModel\ExistingOrderedCatalogModelDTO;

/**
 * Subsystem for interaction with stored information on order's models.
 *
 * Current purposes:
 * 1. Retrieving models from particular order
 * 2. Adding a new model to an order
 * 3. Updating details of an ordered model
 * 4. Removing a model from an order
 * 5. Checking if a model exists in an order.
 */
class OrderedModelRepository
{
    /**
     * @return int[]
     */
    private function getSupportedFilamentTypes(int $printingTechnologyId) : array
    {
        return DB::table('printing_technologies_of_filament_type')
                    ->where('printing_technology_id', '=', $printingTechnologyId)
                    ->pluck('filament_type_id')
                    ->toArray();
    }

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
            $supportedFilamentTypes = $this->getSupportedFilamentTypes($id);

            $result []= new PrintingTechnologyWithPriceDTO($id, $name, $description, $supportedFilamentTypes, $price);
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
                     ->select(['ft.id AS id',
                               'ft.name AS name',
                               'ft.description AS description',
                               'ft.strength AS strength',
                               'ft.hardness AS hardness',
                               'ft.impact_resistance AS impact_resistance',
                               'ft.durability AS durability',
                               'ft.min_work_temperature AS min_work_temperature',
                               'ft.max_work_temperature AS max_work_temperature',
                               'ft.food_contact_allowed AS food_contact_allowed',
                               'p.price AS price'])
                     ->get();

        $result = [];
        foreach ($entries as $entry)
        {
            $id = $entry->id;
            $name = $entry->name;
            $description = $entry->description;
            $price = $entry->price;
            $strength = $entry->strength;
            $hardness = $entry->hardness;
            $impactResistance = $entry->impact_resistance;
            $durability = $entry->durability;
            $minWorkTemperature = $entry->min_work_temperature;
            $maxWorkTemperature = $entry->max_work_temperature;
            $isFoodContactAllowed = $entry->food_contact_allowed;

            $characteristics = new FilamentTypeCharacteristics($strength, $hardness, $impactResistance, $durability, $minWorkTemperature, $maxWorkTemperature, $isFoodContactAllowed);

            $result []= new FilamentTypeWithPriceDTO($id, $name, $description, $characteristics, $price);
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
     * Fetches a model from order.
     *
     * Returns null if ordered model not exists
     * or if this ordered model do not belong to user.
     *
     * @param int $id Ordered model's identifier
     */
    public function get(int $id, int $userId) : ExistingOrderedCatalogModelDTO | null
    {
        // ...
    }

    /**
     * Returns data required to add a model
     * from the catalogue to the user's order.
     *
     * Returns null if model not exists
     *
     * @param int $modelId Base model's identifier
     */
    public function getOnlyCatalogPrices(int $modelId) : NewOrderedCatalogModelDTO | null
    {
        $entry = DB::table('models')->select(['name', 'price_holed', 'price_solid', 'price_parted', 'price_not_parted'])
                                    ->find($modelId);

        if ($entry === null)
            return null;

        $id = $modelId;
        $name = $entry->name;
        $printingTechnologies = $this->getPrintingTechnologiesWithPrices($modelId);
        $filamentTypes = $this->getFilamentTypesWithPrices($modelId);
        $colors = $this->getColorsWithPrices($modelId);
        $modelSizes = $this->getModelSizesWithPrices($modelId);
        $additionalServices = $this->getAdditionalServicesWithPrices($modelId);
        $priceHoled = $entry->price_holed;
        $priceSolid = $entry->price_solid;
        $priceParted = $entry->price_parted;
        $priceNotParted = $entry->price_not_parted;
        return new NewOrderedCatalogModelDTO($id,
                                             $name,
                                             $printingTechnologies,
                                             $filamentTypes,
                                             $colors,
                                             $modelSizes,
                                             $additionalServices,
                                             $priceHoled,
                                             $priceSolid,
                                             $priceParted,
                                             $priceNotParted);
    }

    /**
     * Retrieves all models from order to display them in
     * shopping cart.
     *
     * @return ShoppingCartDTO
     *
     * TODO OrderedModelsRepository is too abstract:
     * admins functionalities need one piece of information,
     * print masters functionalities - another,
     * customers - another.
     */
    public function getAllAsShoppingCart(int $userId, int $orderId) : ShoppingCartDTO
    {
        // ...
    }

    /**
     * Removes a model from the order.
     *
     * @param int $id Ordered model's identifier
     * @param int $userId Identifier of the user whose ordered model will be removed
     * @param int $orderId Identifier of the order from which the model will be removed
     */
    public function remove(int $id, int $userId, int $orderId) : void
    {
        // ...
    }

    /**
     * Checks if the model with given configuration is in the user's order
     */
    public function exists(OrderedCatalogModelViewModel $model, int $userId, int $orderId) : bool
    {
        // ...
    }

    /**
     * Adds model to the order.
     *
     * @param OrderedCatalogModelViewModel $model
     * Information on new ordered model.
     * @param OrderModelAdditionErrors $errors
     * An object for storing operation errors.
     */
    public function add(OrderedCatalogModelViewModel $model,
                        int $orderId,
                        OrderModelAdditionErrors $errors) : void
    {
        // ...
    }

    /**
     * Updates model in the order
     *
     * @param OrderedCatalogModelViewModel $model
     * Information on ordered model.
     * @param OrderedModelUpdateErrors $errors
     * An object for storing operation errors.
     */
    public function update(OrderedCatalogModelViewModel $model,
                           int $orderId,
                           OrderedModelUpdateErrors $errors) : void
    {
        // ...
    }
}
