<?php

namespace App\Repositories\Admin;

use stdClass;
use App\Enums\OrderStatus;
use Illuminate\Support\Facades\DB;
use App\DTOs\Admin\Orders\OrderDTO;
use App\DTOs\Admin\Orders\OrderInfo;
use App\DTOs\Admin\Orders\BaseModelInfo;
use App\DTOs\Admin\Orders\ModelSizeInfo;
use App\DTOs\Admin\Orders\FilamentTypeInfo;
use App\DTOs\Admin\Orders\OrderedModelInfo;
use App\DTOs\Admin\Orders\OrderItemListDTO;
use App\DTOs\Admin\Orders\AdditionalServiceInfo;
use App\DTOs\Admin\Orders\PrintingTechnologyInfo;

/**
 * Subsystem for interaction with stored information on user's orders (administrator)
 */
class OrderRepository
{
    private function getOrderInfo(stdClass $entry) : OrderInfo
    {
        return new OrderInfo($entry->order_id,
                             $entry->order_status,
                             $entry->order_payed_at,
                             $entry->order_completed_at);
    }

    /**
     * Retrieves all orders.
     *
     * @return OrderItemListDTO[]
     */
    public function getAll() : array
    {
        $entries = DB::table('orders AS o')
                     ->join('users AS u', 'u.id', '=', 'o.customer_id')
                     ->get(['u.email         AS user_email',
                            'o.id            AS order_id',
                            'o.status        AS order_status',
                            'o.payed_at      AS order_payed_at',
                            'o.completed_at  AS order_completed_at']);

        $result = [];
        foreach ($entries as $entry)
        {
            $orderInfo = $this->getOrderInfo($entry);
            $result []= new OrderItemListDTO($entry->user_email, $orderInfo);
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
        $printingTechnologyInfo = $this->getPrintingTechnologyInfo($entry);
        $filamentTypeInfo = $this->getFilamentTypeInfo($entry);
        $colorCode = $entry->color_code;
        $modelSizeInfo = $this->getModelSizeInfo($entry);

        return new OrderedModelInfo($modelInfo,
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
     * Retrieves order with its models.
     *
     * @return OrderDTO
     */
    public function get(int $orderId) : OrderDTO | null
    {
        $entries = DB::select(
            'SELECT
                om.id               AS ordered_model_id,
                u.email             AS user_email,
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

                JOIN users AS u
                    ON u.id = o.customer_id

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
        $userEmail = $entries[0]->user_email;

        $models = [];
        foreach ($entries as $entry)
        {
            $additionalServicesInfos = $this->getAdditionalServicesInfos($entry->ordered_model_id);
            $models []= $this->getOrderedModelsInfo($entry, $additionalServicesInfos);
        }

        return new OrderDTO($userEmail, $orderInfo, $models);
    }

    /**
     * Retrieves order's status
     */
    public function getStatus(int $orderId) : OrderStatus|null
    {
        $entry = DB::table('orders')->select('status')->find($orderId);

        if ($entry === null)
            return null;

        return OrderStatus::GetByValue($entry->status);
    }

    /**
     * Sets new status to order.
     */
    public function setStatus(int $orderId, OrderStatus $status) : void
    {
        DB::table('orders')->where('id', $orderId)
                           ->update(['status' => $status]);
    }
}
