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

    /**
     * Returns the order's status
     */
    public function getOrderStatus() : string
    {
        switch ($this->orderStatus)
        {
            case OrderStatus::WaitingForPayment:
                return 'Ожидает оплаты';
            case OrderStatus::OnExecution:
                return 'Выполняется';
            case OrderStatus::OnDelivery:
                return 'В доставке';
            case OrderStatus::Completed:
                return 'Выполнен';
            default:
                assert(false, 'Unknown order status: ' . $this->orderStatus->name);
                return 'Произошла ошибка';
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

    public function getTotalPrice() : float
    {
        return $this->totalPrice;
    }
}
