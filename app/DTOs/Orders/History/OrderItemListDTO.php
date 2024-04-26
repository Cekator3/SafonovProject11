<?php

namespace App\DTOs\Orders\History;

/**
 * A subsystem for reading application data specifically
 * to display a list of orders (administrator).
 */
class OrderItemListDTO
{
    private OrderInfo $orderInfo;

    public function __construct(OrderInfo $orderInfo)
    {
        $this->orderInfo = $orderInfo;
    }

    /**
     * Returns the id of the order
     */
    public function getId() : int
    {
        return $this->orderInfo->getId();
    }

    /**
     * Returns the status of the order
     */
    public function getStatus() : string
    {
        return $this->orderInfo->getStatusAsString();
    }

    /**
     * Returns the order's payment date.
     */
    public function getPaymentDate() : string
    {
        return $this->orderInfo->getPaymentDate();
    }

    /**
     * Returns the order's completion date.
     */
    public function getCompletionDate() : string
    {
        return $this->orderInfo->getCompletionDate();
    }
}
