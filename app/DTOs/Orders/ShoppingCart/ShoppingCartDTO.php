<?php

namespace App\DTOs\Orders\ShoppingCart;

use App\Enums\OrderStatus;

/**
 * A subsystem for reading application data about the order
 * and it's models.
 */
final class ShoppingCartDTO
{
    private int $orderId;
    private OrderStatus $orderStatus;
    /**
     * @var ModelDTO[]
     */
    private array $models;
    private float $totalPrice = 0.0;

    /**
     * @param ModelDTO[] $models
     */
    public function __construct(int $orderId, string $orderStatus, array $models)
    {
        $this->orderId = $orderId;
        $this->orderStatus = OrderStatus::GetByValue($orderStatus);
        $this->models = $models;

        foreach ($models as $model)
            $this->totalPrice += $model->getPrice() * $model->getAmount();
    }

    public function getOrderId() : int
    {
        return $this->orderId;
    }

    public function isOrderCanBeChanged() : bool
    {
        return $this->orderStatus === OrderStatus::New;
    }

    /**
     * Returns the order's status
     */
    public function getOrderStatus() : string
    {
        switch ($this->orderStatus) {
            case OrderStatus::New:
                return 'Новый';
            case OrderStatus::WaitingForPayment:
                return 'ОЖИДАЕТ ОПЛАТЫ';
            case OrderStatus::OnExecution:
                return 'ВЫПОЛНЯЕТСЯ';
            case OrderStatus::Completed:
                return 'ВЫПОЛНЕН';
            default:
                assert(false, 'Unknown order status: ' . $this->orderStatus->name);
                return 'ПРОИЗОШЛА ОШИБКА';
        }
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

    /**
     * Returns true if at least one model exists in the order.
     */
    public function hasAnyModels() : bool
    {
        return count($this->models) !== 0;
    }

    /**
     * Returns total price for all models in the order.
     */
    public function getTotalPrice() : float
    {
        return $this->totalPrice;
    }
}
