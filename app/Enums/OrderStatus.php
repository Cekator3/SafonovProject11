<?php
namespace App\Enums;

use Exception;

enum OrderStatus : int
{
    case WaitingForPayment = 1;
    case OnExecution = 2;
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
            static::Completed->value
        ];
    }

    public static function HasValue(int $value) : bool
    {
        return in_array($value, static::GetAllValues());
    }

    /**
     * Returns enum value by associated with OrderStatus enum value.
     *
     * @throws Exception if given order status not exists
     */
    public static function GetByValue(int $orderStatus) : OrderStatus
    {
        switch ($orderStatus)
        {
            case static::WaitingForPayment->value:
                return static::WaitingForPayment;
            case static::OnExecution->value:
                return static::OnExecution;
            case static::Completed->value:
                return static::Completed;
            default:
                throw new Exception('Given order status not exists');
        }
    }
}
