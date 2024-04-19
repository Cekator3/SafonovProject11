<?php

namespace App\Repositories\Orders;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\DTOs\Orders\ShoppingCart\ModelDTO;
use App\Errors\Orders\OrderedModelUpdateErrors;
use App\Errors\Orders\OrderModelAdditionErrors;
use App\DTOs\Orders\ShoppingCart\ShoppingCartDTO;
use App\ViewModels\Orders\OrderedCatalogModelViewModel;
use Illuminate\Database\UniqueConstraintViolationException;
use App\DTOs\Admin\FilamentTypes\FilamentTypeCharacteristics;
use App\DTOs\Orders\NewOrderedCatalogModel\ColorWithPriceDTO;
use App\DTOs\Orders\NewOrderedCatalogModel\ModelSizeWithPriceDTO;
use App\DTOs\Orders\NewOrderedCatalogModel\FilamentTypeWithPriceDTO;
use App\DTOs\Orders\NewOrderedCatalogModel\NewOrderedCatalogModelDTO;
use App\DTOs\Orders\NewOrderedCatalogModel\AdditionalServiceWithPriceDTO;
use App\DTOs\Orders\NewOrderedCatalogModel\PrintingTechnologyWithPriceDTO;
use App\DTOs\Orders\ExistingOrderedCatalogModel\ExistingOrderedCatalogModelDTO;
use stdClass;

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
     * @return Collection
     */
    private function getPrintingTechnologiesEntries(int $baseModelId) : Collection
    {
        return DB::table('printing_technologies AS pt')
                     ->leftJoinLateral(
                            DB::table('printing_technologies_prices')
                              ->whereColumn('printing_technology_id', '=', 'pt.id')
                              ->where('model_id', '=', $baseModelId)
                              ->select(['price'])
                              ->limit(1)
                        , 'p')
                     ->select(['pt.id AS id', 'pt.name AS name', 'pt.description AS description', 'p.price AS price'])
                     ->get();
    }

    /**
     * @return PrintingTechnologyWithPriceDTO[]
     */
    private function getPrintingTechnologiesForAddingCatalogModelToOrder(int $baseModelId) : array
    {
        $entries = $this->getPrintingTechnologiesEntries($baseModelId);

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
     * @return \App\DTOs\Orders\ExistingOrderedCatalogModel\PrintingTechnologyWithPriceDTO[]
     */
    private function getPrintingTechnologiesForUpdatingCatalogModelInOrder(int $baseModelId, int $selectedPrintingTechnologyId) : array
    {
        $entries = $this->getPrintingTechnologiesEntries($baseModelId);

        $result = [];
        foreach ($entries as $entry)
        {
            $id = $entry->id;
            $name = $entry->name;
            $description = $entry->description;
            $price = $entry->price ?? 0.0;
            $supportedFilamentTypes = $this->getSupportedFilamentTypes($id);

            $result []= new \App\DTOs\Orders\ExistingOrderedCatalogModel\PrintingTechnologyWithPriceDTO($id, $name, $description, $id === $selectedPrintingTechnologyId, $supportedFilamentTypes, $price);
        }
        return $result;
    }

    private function getFilamentTypesEntries(int $baseModelId) : Collection
    {
        return DB::table('filament_types AS ft')
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
    }

    /**
     * @return FilamentTypeWithPriceDTO[]
     */
    private function getFilamentTypesForAddingCatalogModelToOrder(int $baseModelId) : array
    {
        $entries = $this->getFilamentTypesEntries($baseModelId);
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
     * @return \App\DTOs\Orders\ExistingOrderedCatalogModel\FilamentTypeWithPriceDTO[]
     */
    private function getFilamentTypesForUpdatingCatalogModelInOrder(int $baseModelId, int $selectedFilamentTypeId) : array
    {
        $entries = $this->getFilamentTypesEntries($baseModelId);
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

            $result []= new \App\DTOs\Orders\ExistingOrderedCatalogModel\FilamentTypeWithPriceDTO($id, $name, $description, $id === $selectedFilamentTypeId, $characteristics, $price);
        }
        return $result;
    }

    private function getColorsEntries(int $baseModelId) : Collection
    {
        return DB::table('colors AS c')
                     ->leftJoinLateral(
                            DB::table('colors_prices')
                              ->whereColumn('color_id', '=', 'c.id')
                              ->where('model_id', '=', $baseModelId)
                              ->select(['price'])
                              ->limit(1)
                        , 'p')
                     ->select(['c.id AS id', 'c.code AS code', 'p.price AS price'])
                     ->get();
    }

    /**
     * Returns all colors with their price for base models (if exists).
     * @return ColorWithPriceDTO[]
     */
    private function getColorsForAddingCatalogModelToOrder(int $baseModelId) : array
    {
        $entries = $this->getColorsEntries($baseModelId);
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
     * @return \App\DTOs\Orders\ExistingOrderedCatalogModel\ColorWithPriceDTO[]
     */
    private function getColorsForUpdatingCatalogModelInOrder(int $baseModelId, int $selectedColorId) : array
    {
        $entries = $this->getColorsEntries($baseModelId);
        $result = [];
        foreach ($entries as $entry)
        {
            $id = $entry->id;
            $code = $entry->code;
            $price = $entry->price ?? 0.0;

            $result []= new \App\DTOs\Orders\ExistingOrderedCatalogModel\ColorWithPriceDTO($id, $code, $id === $selectedColorId, $price);
        }
        return $result;
    }

    private function getModelSizesEntries(int $baseModelId) : Collection
    {
        return DB::table('models_sizes AS s')
                     ->where('s.model_id', '=', $baseModelId)
                     ->select(['s.id AS id', 's.size_multiplier AS size_multiplier', 's.length AS length', 's.width AS width', 's.height AS height', 's.price AS price'])
                     ->get();
    }

    /**
     * @return ModelSizeWithPriceDTO[]
     */
    private function getModelSizesForAddingCatalogModelToOrder(int $baseModelId) : array
    {
        $entries = $this->getModelSizesEntries($baseModelId);
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
     * @return \App\DTOs\Orders\ExistingOrderedCatalogModel\ModelSizeWithPriceDTO[]
     */
    private function getModelSizesForUpdatingCatalogModelInOrder(int $baseModelId, int $selectedModelSizeId) : array
    {
        $entries = $this->getModelSizesEntries($baseModelId);
        $result = [];
        foreach ($entries as $entry)
        {
            $id = $entry->id;
            $isSelected = $id === $selectedModelSizeId;
            $multiplier = $entry->size_multiplier;
            $length = $entry->length;
            $width = $entry->width;
            $height = $entry->height;
            $price = $entry->price ?? 0.0;

            $result []= new \App\DTOs\Orders\ExistingOrderedCatalogModel\ModelSizeWithPriceDTO($id, $isSelected, $multiplier, $length, $width, $height, $price);
        }
        return $result;
    }

    private function getAdditionalServicesEntries(int $baseModelId) : Collection
    {
        return DB::table('additional_services AS s')
                 ->leftJoinLateral(
                     DB::table('additional_services_prices')
                         ->whereColumn('additional_service_id', '=', 's.id')
                         ->where('model_id', '=', $baseModelId)
                         ->select(['price'])
                         ->limit(1)
                 , 'p')
                 ->select(['s.id AS id', 's.name AS name', 's.description AS description', 's.preview_image AS preview_image', 'p.price AS price'])
                 ->get();
    }

    /**
     * @return AdditionalServiceWithPriceDTO[]
     */
    private function getAdditionalServicesForAddingCatalogModelToOrder(int $baseModelId) : array
    {
        $entries = $this->getAdditionalServicesEntries($baseModelId);
        $result = [];
        foreach ($entries as $entry)
        {
            // getModelSizesForAddingCatalogModelToOrder
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
     * @param int[] $selectedAdditionalServicesIds
     * @return \App\DTOs\Orders\ExistingOrderedCatalogModel\AdditionalServiceWithPriceDTO[]
     */
    private function getAdditionalServicesForUpdatingCatalogModelInOrder(int $baseModelId, array $selectedAdditionalServicesIds) : array
    {
        $entries = $this->getAdditionalServicesEntries($baseModelId);
        $result = [];
        foreach ($entries as $entry)
        {
            $id = $entry->id;
            $isSelected = in_array($baseModelId, $selectedAdditionalServicesIds, true);
            $name = $entry->name;
            $description = $entry->description;
            $previewImage = $entry->preview_image;
            $price = $entry->price ?? 0.0;

            $result []= new \App\DTOs\Orders\ExistingOrderedCatalogModel\AdditionalServiceWithPriceDTO($id, $name, $description, $isSelected, $previewImage, $price);
        }
        return $result;
    }

    /**
     * @return int[]
     */
    private function getAdditionalServicesOfOrderedModel(int $orderedModelId) : array
    {
        return DB::table('additional_services_of_ordered_models')
                    ->where('ordered_model_id', '=', $orderedModelId)
                    ->pluck('additional_service_id')
                    ->toArray();
    }

    /**
     * Fetches a model from order.
     *
     * Returns null if ordered model not exists
     * or if this ordered model do not belong to user.
     *
     * @param int $id Ordered model's identifier
     */
    public function get(int $id) : ExistingOrderedCatalogModelDTO | null
    {
        $entry = DB::table('ordered_models AS om')
                   ->join('models AS m', 'm.id', '=', 'om.model_id')
                   ->find($id)
                   ->first([
                        'om.id AS ordered_model_id',
                        'om.model_id AS model_id',
                        'm.name AS model_name',
                        'om.amount AS amount',
                        'om.is_holed AS is_holed',
                        'om.is_parted AS is_parted',
                        'm.price_holed AS price_holed',
                        'm.price_solid AS price_solid',
                        'm.price_parted AS price_parted',
                        'm.price_not_parted AS price_not_parted',

                        'om.printing_technology_id AS selected_printing_technology_id',
                        'om.filament_type_id AS selected_filament_type_id',
                        'om.color_id AS selected_color_id',
                        'om.model_size_id AS selected_model_size_id'
                   ]);

        if ($entry === null)
            return null;

        $selectedAdditionalServices = $this->getAdditionalServicesOfOrderedModel($id);

        $printingTechnologies = $this->getPrintingTechnologiesForUpdatingCatalogModelInOrder($entry->model_id, $entry->selected_printing_technology_id);
        $filamentTypes = $this->getFilamentTypesForUpdatingCatalogModelInOrder($entry->model_id, $entry->selected_filament_type_id);
        $colors = $this->getColorsForUpdatingCatalogModelInOrder($entry->model_id, $entry->selected_color_id);
        $modelSizes = $this->getModelSizesForUpdatingCatalogModelInOrder($entry->model_id, $entry->selected_model_size_id);
        $additionalServices = $this->getAdditionalServicesForUpdatingCatalogModelInOrder($entry->model_id, $selectedAdditionalServices);

        return new ExistingOrderedCatalogModelDTO($id,
                                                  $entry->model_id,
                                                  $entry->model_name,
                                                  $entry->amount,
                                                  $printingTechnologies,
                                                  $filamentTypes,
                                                  $colors,
                                                  $modelSizes,
                                                  $additionalServices,
                                                  $entry->is_holed,
                                                  $entry->is_parted,
                                                  $entry->price_holed,
                                                  $entry->price_solid,
                                                  $entry->price_parted,
                                                  $entry->price_not_parted);
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
        $printingTechnologies = $this->getPrintingTechnologiesForAddingCatalogModelToOrder($modelId);
        $filamentTypes = $this->getFilamentTypesForAddingCatalogModelToOrder($modelId);
        $colors = $this->getColorsForAddingCatalogModelToOrder($modelId);
        $modelSizes = $this->getModelSizesForAddingCatalogModelToOrder($modelId);
        $additionalServices = $this->getAdditionalServicesForAddingCatalogModelToOrder($modelId);
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
     * @return ModelDTO[]
     */
    private function getShoppingCartItems(int $orderId) : array
    {
        // shopping_cart_items.sql
        $entries = DB::select(
            'SELECT
                om.id               AS ordered_model_id,
                m.name              AS name,
                m.preview_image     AS thumbnail,
                om.amount           AS amount,

                CASE
                    WHEN om.is_parted AND om.is_holed THEN
                        om.amount * (price + m.price_parted + m.price_holed)
                    WHEN om.is_parted AND NOT om.is_holed THEN
                        om.amount * (price + m.price_parted + m.price_solid)
                    WHEN NOT om.is_parted AND om.is_holed THEN
                        om.amount * (price + m.price_not_parted + m.price_holed)
                    ELSE
                        om.amount * (price + m.price_not_parted + m.price_solid)
                END AS price

            FROM
                ordered_models AS om

                JOIN models AS m
                    ON m.id = om.model_id

                -- Calculating printing prices
                CROSS JOIN LATERAL (
                    SELECT
                        SUM(price) AS price
                    FROM
                    (
                        -- model size price
                        (SELECT
                            price
                        FROM
                            models_sizes AS ms
                        WHERE
                            ms.id = om.model_size_Id
                        LIMIT 1)

                        UNION ALL

                        -- printing technology price
                        (SELECT
                            price
                        FROM
                            printing_technologies_prices AS ptp
                        WHERE
                            ptp.printing_technology_id = om.printing_technology_id AND
                            ptp.model_id = om.model_id
                        LIMIT 1)

                        UNION ALL

                        -- Filament type price
                        (SELECT
                            price
                        FROM
                            filament_types_prices AS ftp
                        WHERE
                            ftp.filament_type_id = om.filament_type_id AND
                            ftp.model_id = om.model_id
                        LIMIT 1)

                        UNION ALL

                        -- Color price
                        (SELECT
                            price
                        FROM
                            colors_prices AS cp
                        WHERE
                            cp.color_id = om.color_id AND
                            cp.model_id = om.model_id
                        LIMIT 1)

                        UNION ALL

                        -- Additional services prices
                        (SELECT
                            SUM(asp.price) AS price

                        FROM
                            additional_services_of_ordered_models AS asom
                            JOIN
                                additional_services_prices AS asp
                            ON
                                asp.additional_service_id = asom.additional_service_id

                        WHERE
                            asom.ordered_model_id = om.id AND
                            asp.model_id = om.model_id)
                    )
                )

            WHERE
                om.order_id = ?;', [$orderId]
        );
    }

    /**
     * Retrieves all models from order to display them in
     * shopping cart. Returns null if order do not exist.
     *
     * @return ShoppingCartDTO
     *
     * TODO OrderedModelsRepository is too abstract:
     * admins functionalities need one piece of information,
     * print masters functionalities - another,
     * customers - another.
     */
    public function getAllAsShoppingCart(int $orderId) : ShoppingCartDTO | null
    {
        $entry = DB::table('orders')->find($orderId)->first('status');
        if ($entry === null)
            return null;

        $status = $entry->status;
        $models = $this->getShoppingCartItems($orderId);
        return new ShoppingCartDTO($status, $models);
    }

    /**
     * Returns true if the ordered model belongs to user
     */
    public function isBelongToUser(int $orderedModelId, int $userId) : bool
    {
        return DB::table('ordered_models AS om')
                    ->join('orders AS o', 'om.order_id', '=', 'o.id')
                    ->where('om.id', '=', $orderedModelId)
                    ->where('o.customer_id', '=', $userId)
                    ->exists();
    }

    /**
     * Removes a model from the order.
     *
     * @param int $id Ordered model's identifier
     */
    public function remove(int $id) : void
    {
        DB::table('ordered_models')->delete($id);
    }

    private function isListsHasSameValues(array $list1, array $list2) : bool
    {
        return (count($list1) === count($list2)) && (! array_diff($list1, $list2));
    }

    /**
     * Checks if the model with given configuration is in the user's order
     */
    public function exists(OrderedCatalogModelViewModel $model, int $orderId) : bool
    {
        $orderedModelId = DB::table('ordered_models')->whereAll([
            ['order_id', '=', $orderId],
            ['model_id', '=', $model->modelId],
            ['model_size_id', '=', $model->modelSizeId],
            ['printing_technology_id', '=', $model->printingTechnologyId],
            ['filament_type_id', '=', $model->filamentTypeId],
            ['color_id', '=', $model->colorId],
            ['is_parted', '=', $model->isParted],
            ['is_holed', '=', $model->isHoled],
        ])->first(['id']);

        $orderedModelId = +$orderedModelId->id;

        if ($orderedModelId === null)
            return false;

        $currAdditionalServices = $this->getAdditionalServicesOfOrderedModel($orderedModelId);
        return $this->isListsHasSameValues($model->additionalServices, $currAdditionalServices);
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
        try
        {
            $id = DB::table('ordered_models')->insertGetId([
                'order_id' => $orderId,
                'model_id' => $model->modelId,
                'model_size_id' => $model->modelSizeId,
                'printing_technology_id' => $model->printingTechnologyId,
                'filament_type_id' => $model->filamentTypeId,
                'color_id' => $model->colorId,
                'amount' => $model->amount,
                'is_holed' => $model->isHoled,
                'is_parted' => $model->isParted
            ]);

            $additionalServicesData = [];
            foreach ($model->additionalServices as $additionalServiceId)
            {
                $additionalServicesData []= [
                    'ordered_model_id' => $id,
                    'additional_service_id' => $additionalServiceId
                ];
            }
            DB::table('additional_services_of_ordered_models')->insert($additionalServicesData);
        }
        catch (UniqueConstraintViolationException $e)
        {
            $errors->add(OrderModelAdditionErrors::ERROR_MODEL_ALREADY_IN_ORDER);
        }
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
                           int $orderedModelId,
                           OrderedModelUpdateErrors $errors) : void
    {
        try
        {
            DB::table('ordered_models')
                        ->where('id', '=', $orderedModelId)
                        ->update([
                'model_size_id' => $model->modelSizeId,
                'printing_technology_id' => $model->printingTechnologyId,
                'filament_type_id' => $model->filamentTypeId,
                'color_id' => $model->colorId,
                'amount' => $model->amount,
                'is_holed' => $model->isHoled,
                'is_parted' => $model->isParted
            ]);

            $additionalServicesData = [];
            foreach ($model->additionalServices as $additionalServiceId)
            {
                $additionalServicesData []= [
                    'ordered_model_id' => $orderedModelId,
                    'additional_service_id' => $additionalServiceId
                ];
            }

            DB::beginTransaction();
            DB::table('additional_services_of_ordered_models')
                            ->where('ordered_model_id', '=', $orderedModelId)
                            ->delete();

            DB::table('additional_services_of_ordered_models')->insert($additionalServicesData);
            DB::commit();
        }
        catch (UniqueConstraintViolationException $e)
        {
            $errors->add(OrderModelAdditionErrors::ERROR_MODEL_ALREADY_IN_ORDER);
        }
    }
}
