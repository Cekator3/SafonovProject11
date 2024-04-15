<?php

namespace App\DTOs\Orders\ShoppingCart;

/**
 * A subsystem for reading application data about the order
 * and it's models.
 */
final class ShoppingCartDTO
{
    private string $orderStatus;
    /**
     * @var ModelDTO[]
     */
    private array $models;

    /**
     * @param ModelDTO[] $models
     */
    public function __construct(string $orderStatus, array $models)
    {
        $this->orderStatus = $orderStatus;
        $this->models = $models;
    }

    /**
     * Returns the order's status
     */
    public function getOrderStatus() : string
    {
        return $this->orderStatus;
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
