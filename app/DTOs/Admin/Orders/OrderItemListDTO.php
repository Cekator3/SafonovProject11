<?php

namespace App\DTOs\Admin\Orders;

/**
 * A subsystem for reading application data specifically
 * to display a list of orders (administrator).
 */
class OrderItemListDTO
{
    // User's info
    private string $customerEmail;
    private OrderInfo $orderInfo;

    public function __construct(string $customerEmail,
                                OrderInfo $orderInfo)
    {
        $this->customerEmail = $customerEmail;
        $this->orderInfo = $orderInfo;
    }

    /**
     * Returns the customer's email
     */
    public function getCustomerEmail() : string
    {
        return $this->customerEmail;
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
        return $this->orderInfo->getStatus();
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
