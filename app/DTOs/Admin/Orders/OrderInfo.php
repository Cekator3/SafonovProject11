<?php

namespace App\DTOs\Admin\Orders;

use DateTime;
use App\Enums\OrderStatus;

/**
 * A subsystem for reading application data about the order (administrator)
 */
class OrderInfo
{
    private int $id;
    private OrderStatus $status;
    private DateTime|null $payedAt;
    private DateTime|null $completedAt;

    public function __construct(int $id, int $status, string|null $payedAt, string|null $completedAt)
    {
        $this->id = $id;
        $this->status = OrderStatus::GetByValue($status);
        $this->payedAt = $payedAt === null ? null : new DateTime($payedAt);
        $this->completedAt = $completedAt === null ? null : new DateTime($completedAt);
    }

    /**
     * Returns the id of the order
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the status of the order
     */
    public function getStatus() : string
    {
        switch ($this->status)
        {
            case OrderStatus::WaitingForPayment:
                return 'ОЖИДАЕТ ОПЛАТЫ';
            case OrderStatus::OnExecution:
                return 'ВЫПОЛНЯЕТСЯ';
            case OrderStatus::Completed:
                return 'ВЫПОЛНЕН';
            default:
                assert(false, 'Unknown order status: ' . $this->status->name);
                return 'ПРОИЗОШЛА ОШИБКА';
        }
    }

    /**
     * Returns the order's payment date.
     */
    public function getPaymentDate() : string
    {
        return $this->payedAt;
    }

    /**
     * Returns the order's completion date.
     */
    public function getCompletionDate() : string
    {
        return $this->completedAt;
    }
}