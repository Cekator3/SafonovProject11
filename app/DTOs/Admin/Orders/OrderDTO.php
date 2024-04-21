<?php

namespace App\DTOs\Admin\Orders;

/**
 * A subsystem for reading application data about the user's order and
 * it's ordered models (administrator)
 */
class OrderDTO
{
    private string $customerEmail;
    private OrderInfo $orderInfo;
    /**
     * @var OrderedModelInfo
     */
    private array $models;

    /**
     * @param OrderedModelInfo[] $models
     */
    public function __construct(string $customerEmail,
                                OrderInfo $orderInfo,
                                array $models)
    {
        $this->customerEmail = $customerEmail;
        $this->orderInfo = $orderInfo;
        $this->models = $models;
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

    /**
     * Returns the ordered models of the user's order.
     *
     * @return OrderedModelInfo[]
     */
    public function getModels() : array
    {
        return $this->models;
    }
}
