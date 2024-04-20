<?php

namespace App\DTOs\Admin\Orders;

/**
 * A subsystem for reading application data specifically
 * to display a list of orders (administrator).
 */
class OrderItemListDTO
{
    // User's info
    private string $userEmail;
    private OrderInfo $orderInfo;

    public function __construct(string $userEmail,
                                OrderInfo $orderInfo)
    {
        $this->userEmail = $userEmail;
        $this->orderInfo = $orderInfo;
    }

    /**
     * Returns the user's email
     */
    public function getUserEmail() : string
    {
        return $this->userEmail;
    }

    /**
     * Returns the id of the order
     */
    public function getOrderId() : int
    {
        return $this->orderInfo->getId();
    }

    /**
     * Returns the status of the order
     */
    public function getOrderStatus() : string
    {
        return $this->orderInfo->getStatus();
    }


    /**
     * Returns the order's payment date.
     */
    public function getOrderPaymentDate() : string
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
