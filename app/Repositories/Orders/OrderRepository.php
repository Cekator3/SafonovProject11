<?php

namespace App\Repositories\Orders;

use stdClass;
use App\Enums\OrderStatus;
use Illuminate\Support\Facades\DB;
use App\DTOs\Orders\History\OrderDTO;
use App\DTOs\Orders\History\OrderInfo;
use App\DTOs\Orders\History\BaseModelInfo;
use App\DTOs\Orders\History\ModelSizeInfo;
use App\Errors\Orders\OrderCreationErrors;
use App\DTOs\Orders\History\FilamentTypeInfo;
use App\DTOs\Orders\History\OrderedModelInfo;
use App\DTOs\Orders\History\OrderItemListDTO;
use App\DTOs\Orders\History\AdditionalServiceInfo;
use App\DTOs\Orders\History\PrintingTechnologyInfo;

/**
 * Subsystem for interaction with stored information on user's orders
 *
 * Current purposes:
 * 1. Retrieving user's order.
 * 2. Retrieving all user's orders.
 * 3. Adding order to user.
 */
class OrderRepository
{
    /**
     * Retrieves the identifier of the user's not payed order.
     *
     * @return int|null User's identifier.
     */
    public function getCurrentOrderId(int $userId) : int | null
    {
        $entry = DB::table('orders')
                           ->where('status', '=', OrderStatus::WaitingForPayment)
                           ->where('customer_id', '=', $userId)
                           ->select('id')
                           ->first();
        if ($entry === null)
            return null;
        return $entry->id;
    }

    private function getOrderInfo(stdClass $entry) : OrderInfo
    {
        return new OrderInfo($entry->order_id,
                             $entry->order_status,
                             $entry->order_payed_at,
                             $entry->order_completed_at);
    }

    /**
     * Retrieves all user's orders.
     *
     * @return OrderItemListDTO[]
     */
    public function getAll(int $userId) : array
    {
        $entries = DB::table('orders')
                            ->where('customer_id', '=', $userId)
                            ->select(
                                'id AS order_id',
                                'status AS order_status',
                                'payed_at AS order_payed_at',
                                'completed_at AS order_completed_at'
                            )
                            ->get();

        $result = [];
        foreach ($entries as $entry)
        {
            $orderInfo = $this->getOrderInfo($entry);
            $result []= new OrderItemListDTO($orderInfo);
        }
        return $result;
    }

    private function getModelInfo(stdClass $entry) : BaseModelInfo
    {
        return new BaseModelInfo($entry->model_id,
                                 $entry->model_name,
                                 $entry->model_thumbnail);
    }

    private function getPrintingTechnologyInfo(stdClass $entry) : PrintingTechnologyInfo
    {
        return new PrintingTechnologyInfo($entry->printing_technology_id,
                                          $entry->printing_technology_name);
    }

    private function getFilamentTypeInfo(stdClass $entry) : FilamentTypeInfo
    {
        return new FilamentTypeInfo($entry->filament_type_id,
                                    $entry->filament_type_name);
    }

    private function getModelSizeInfo(stdClass $entry) : ModelSizeInfo
    {
        return new ModelSizeInfo($entry->model_size_multiplier,
                                 $entry->model_length,
                                 $entry->model_height,
                                 $entry->model_width);
    }

    /**
     * @param AdditionalServiceInfo[] $additionalServicesInfo
     */
    private function getOrderedModelsInfo(stdClass $entry, array $additionalServicesInfo) : OrderedModelInfo
    {
        $modelInfo = $this->getModelInfo($entry);
        $amount = $entry->amount;
        $printingTechnologyInfo = $this->getPrintingTechnologyInfo($entry);
        $filamentTypeInfo = $this->getFilamentTypeInfo($entry);
        $colorCode = $entry->color_code;
        $modelSizeInfo = $this->getModelSizeInfo($entry);

        return new OrderedModelInfo($modelInfo,
                                    $amount,
                                    $printingTechnologyInfo,
                                    $filamentTypeInfo,
                                    $colorCode,
                                    $modelSizeInfo,
                                    $additionalServicesInfo);
    }

    /**
     * @return AdditionalServiceInfo[]
     */
    private function getAdditionalServicesInfos(int $orderedModelId) : array
    {
        $entries = DB::table('additional_services_of_ordered_models AS asom')
                     ->join('additional_services AS s',
                                's.id', '=', 'asom.additional_service_id')
                     ->where('asom.ordered_model_id', '=', $orderedModelId)
                     ->get(['s.id   AS id',
                            's.name AS name']);

        $result = [];

        foreach ($entries as $entry)
            $result []= new AdditionalServiceInfo($entry->id, $entry->name);

        return $result;
    }

    /**
     * Retrieves user's order.
     */
    public function get(int $userId, int $orderId) : OrderDTO | null
    {
        $entries = DB::select(
            'SELECT
                om.id               AS ordered_model_id,
                om.amount           AS amount,
                o.status            AS order_status,
                o.payed_at          AS order_payed_at,
                o.completed_at      AS order_completed_at,
                m.id                AS model_id,
                m.name              AS model_name,
                m.preview_image     AS model_thumbnail,
                pt.id               AS printing_technology_id,
                pt.name             AS printing_technology_name,
                ft.id               AS filament_type_id,
                ft.name             AS filament_type_name,
                c.code              AS color_code,
                ms.size_multiplier  AS model_size_multiplier,
                ms.length           AS model_length,
                ms.width            AS model_width,
                ms.height           AS model_height

            FROM
                ordered_models AS om

                JOIN orders AS o
                    ON o.id = om.order_id

                JOIN models AS m
                    ON m.id = om.model_id

                JOIN printing_technologies AS pt
                    ON pt.id = om.printing_technology_id

                JOIN filament_types AS ft
                    ON ft.id = om.filament_type_id

                JOIN colors AS c
                    on c.id = om.color_id

                JOIN models_sizes AS ms
                    on ms.id = om.model_size_Id

            WHERE
                om.order_id = ?', [$orderId]);

        if ($entries === null)
            return null;


        $entries[0]->order_id = $orderId;
        $orderInfo = $this->getOrderInfo($entries[0]);

        $models = [];
        foreach ($entries as $entry)
        {
            $additionalServicesInfos = $this->getAdditionalServicesInfos($entry->ordered_model_id);
            $models []= $this->getOrderedModelsInfo($entry, $additionalServicesInfos);
        }

        return new OrderDTO($orderInfo, $models);
    }

    /**
     * Checks if order belongs to user
     */
    public function belongsToUser(int $orderId, int $userId) : bool
    {
        return DB::table('orders')
                        ->where('id', '=', $orderId)
                        ->where('customer_id', '=', $userId)
                        ->exists();
    }

    /**
     * Adds new order for user.
     *
     * @param int $orderId Identifier of created order.
     */
    public function add(int $userId, int|null &$orderId, OrderCreationErrors $errors) : void
    {
        $orderId = DB::table('orders')->insertGetId([
            'customer_id' => $userId,
            'status' => OrderStatus::WaitingForPayment
        ]);
    }
}
