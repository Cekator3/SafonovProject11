<?php

namespace App\ViewModels\Admin\BaseModel\Price;


/**
 * Class for transferring printing technology's price
 * input from interfaces (views)
 * to the application (services and repositories).
 */
class PrintingTechnologyPrice
{
    public int $id;
    public float $price;

    /**
     * @var string $inputName the name of the input.
     * It will be used to add errors to the input.
     */
    public string $inputName;
}
