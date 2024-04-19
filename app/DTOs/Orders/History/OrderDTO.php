<?php

namespace App\DTOs\Orders\History;

use App\Enums\OrderStatus;
use DateTime;

/**
 * A subsystem for reading application data about order from user's orders history.
 */
class OrderDTO
{
    private int $id;
    private OrderStatus $status;
    private DateTime|null $completed_at = null;
    private DateTime|null $payed_at = null;
    /**
     * @var ModelDTO[]
     */
    private array $models;

    /**
     * @param ModelDTO[] $models
     */
    public function __construct(int $id, int $status, array $models, string $payedAt = '', string $completedAt = '')
    {
        $this->id = $id;
        $this->models = $models;
        $this->status = OrderStatus::GetByValue($status);
        if (! empty($completedAt))
            $this->completed_at = new DateTime($completedAt);
        if (! empty($payedAt))
            $this->payed_at = new DateTime($payedAt);
    }

    /**
     * Returns the identifier of the order.
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the order's status
     */
    public function getStatus() : OrderStatus
    {
        return $this->status;
    }

    /**
     * Returns the order's completion date.
     */
    public function getCompletionDate() : DateTime|null
    {
        return $this->completed_at;
    }

    /**
     * Returns the order's payment date.
     */
    public function getPaymentDate() : DateTime|null
    {
        return $this->payed_at;
    }

    /**
     * Returns the order's models.
     *
     * @return ModelDTO[]
     */
    public function getModels() : array
    {
        return $this->models;
    }
}
