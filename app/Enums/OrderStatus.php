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
}
