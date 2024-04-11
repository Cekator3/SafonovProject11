<?php

namespace App\ViewModels\Admin\BaseModel\Price;


/**
 * Class for transferring color's price
 * input from interfaces (views)
 * to the application (services and repositories).
 */
class ColorPrice
{
    public int $id;
    public float $price;
}
