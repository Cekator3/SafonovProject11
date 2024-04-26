<?php

namespace App\DTOs\Orders\History;

use Exception;
use App\Enums\OrderStatus;

/**
 * A subsystem for reading application data about the user's order and
 * it's ordered models (administrator)
 */
class OrderDTO
{
    private OrderInfo $orderInfo;
    /**
     * @var OrderedModelInfo
     */
    private array $models;

    /**
     * @param OrderedModelInfo[] $models
     */
    public function __construct(OrderInfo $orderInfo,
                                array $models)
    {
        $this->orderInfo = $orderInfo;
        $this->models = $models;
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
    public function getStatus() : OrderStatus
    {
        return $this->orderInfo->getStatus();
    }

    /**
     * Returns the status of the order
     */
    public function getStatusAsString() : string
    {
        return $this->orderInfo->getStatusAsString();
    }

    /**
     * Returns all existing order statuses
     * @return OrderStatus[]
     */
    public function getAllStatuses() : array
    {
        return OrderStatus::cases();
    }

    public function getStatusString(OrderStatus $status) : string
    {
        switch ($status)
        {
            case OrderStatus::WaitingForPayment:
                return 'Ожидает оплаты';
            case OrderStatus::OnExecution:
                return 'Выполняется';
            case OrderStatus::Completed:
                return 'Выполнен';
            default:
                throw new Exception('Given order status not exists');
        }
    }

    /**
     * Checks if the order has been payed by the customer
     */
    public function isPayed() : bool
    {
        return $this->orderInfo->getPaymentDate() !== '';
    }

    /**
     * Returns the order's payment date.
     */
    public function getPaymentDate() : string
    {
        return $this->orderInfo->getPaymentDate();
    }

    /**
     * Checks if the order was completed
     */
    public function isCompleted() : bool
    {
        return $this->orderInfo->getCompletionDate() !== '';
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

    /**
     * Checks if any ordered model exists in the user's order
     */
    public function hasAnyModels() : bool
    {
        return count($this->models) !== 0;
    }
}
