<?php
namespace App\Enums;

enum OrderStatus : string
{
    case WaitingForPayment = 'waiting_for_payment';
    case OnExecution = 'on_execution';
    case OnDelivery = 'on_delivery';
    case Completed = 'completed';

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
