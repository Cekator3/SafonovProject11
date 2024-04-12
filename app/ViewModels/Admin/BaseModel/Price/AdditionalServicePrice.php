<?php

namespace App\ViewModels\Admin\BaseModel\Price;


/**
 * Class for transferring additional service's price
 * input from interfaces (views)
 * to the application (services and repositories).
 */
class AdditionalServicePrice
{
    public int $id;
    public float $price;

    /**
     * @var string $inputName the name of the input.
     * It will be used to add errors to the input.
     */
    public string $inputName;
}
