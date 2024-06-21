<?php

namespace App\DTOs\Orders\History;

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
    public function getStatus() : OrderStatus
    {
        return $this->status;
    }

    /**
     * Returns the status of the order
     */
    public function getStatusAsString() : string
    {
        switch ($this->status) {
            case OrderStatus::New:
                return 'Новый';
            case OrderStatus::WaitingForPayment:
                return 'Ожидает оплаты';
            case OrderStatus::OnExecution:
                return 'Выполняется';
            case OrderStatus::Completed:
                return 'Выполнен';
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
        if ($this->payedAt === null)
            return '';
        return $this->payedAt->format('d-m-Y h:m:s');
    }

    /**
     * Returns the order's completion date.
     */
    public function getCompletionDate() : string
    {
        if ($this->completedAt === null)
            return '';
        return $this->completedAt->format('d-m-Y h:m:s');
    }
}
