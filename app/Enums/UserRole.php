<?php
namespace App\Enums;

enum UserRole : string
{
    case Customer = 'customer';
    case Admin = 'admin';

    /**
     * Returns values associated with UserRole enum.
     * @return array<string>
     */
    public static function GetAllValues() : array
    {
        return [
            static::Customer->value,
            static::Admin->value,
        ];
    }
}
