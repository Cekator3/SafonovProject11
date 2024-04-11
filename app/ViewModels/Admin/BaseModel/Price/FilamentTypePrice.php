<?php

namespace App\ViewModels\Admin\BaseModel\Price;


/**
 * Class for transferring filament type's price
 * input from interfaces (views)
 * to the application (services and repositories).
 */
class FilamentTypePrice
{
    public int $id;
    public float $price;
}
