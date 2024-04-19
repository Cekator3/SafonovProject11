<?php
namespace App\Enums;

enum OrderStatus : int
{
    case WaitingForPayment = 1;
    case OnExecution = 2;
    case OnDelivery = 3;
    case Completed = 4;

    /**
     * Returns values associated with OrderStatus enum.
     * @return array<string>
     */
    public static function GetAllValues() : array
    {
        return [
            static::WaitingForPayment->value,
            static::OnExecution->value,
            static::OnDelivery->value,
            static::Completed->value,
        ];
    }

    /**
     * Returns enum value by associated with OrderStatus enum value.
     */
    public static function GetByValue(int $orderStatus) : OrderStatus
    {
        switch ($orderStatus)
        {
            case static::WaitingForPayment->value:
                return static::WaitingForPayment;
            case static::OnExecution->value:
                return static::OnExecution;
            case static::OnDelivery->value:
                return static::OnDelivery;
            case static::Completed->value:
                return static::Completed;
            default:
                assert(false, 'Given order status not exists');
                return static::WaitingForPayment;
        }
    }
}
