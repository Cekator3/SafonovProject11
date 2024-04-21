<?php

namespace App\Services\Admin\Orders;

use App\DTOs\Admin\Orders\OrderDTO;
use App\DTOs\Admin\Orders\OrderedModelInfo;
use App\DTOs\Admin\Orders\OrderItemListDTO;
use App\Repositories\Admin\OrderRepository;
use App\Repositories\Images\BaseModelThumbnailRepository;

/**
 * Subsystem for getting stored information on orders (admin).
 */
class OrdersGetterService
{
    /**
     * Retrieves all orders.
     *
     * @return OrderItemListDTO[]
     */
    public function getAll() : array
    {
        $orders = new OrderRepository();
        return $orders->getAll();
    }

    /**
     * @param OrderedModelInfo[]
     */
    public function setModelsThumbnailUrl(array $models)
    {
        $thumbnails = new BaseModelThumbnailRepository;
        foreach ($models as $model)
        {
            $thumbnailFilename = $model->getThumbnailFilename();
            $thumbnailUrl = $thumbnails->get($thumbnailFilename);
            $model->setThumbnailUrl($thumbnailUrl);
        }
    }

    /**
     * Retrieves order with its models
     */
    public function get(int $orderId) : OrderDTO|null
    {
        $orders = new OrderRepository();

        $order = $orders->get($orderId);
        $this->setModelsThumbnailUrl($order->getModels());

        return $order;
    }
}
