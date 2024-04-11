<?php

namespace App\ViewModels\Admin\BaseModel\Price;


/**
 * Class for transferring base model's size price
 * input from interfaces (views)
 * to the application (services and repositories).
 */
class BaseModelSizePrice
{
    public int $id;
    public float $price;
}
