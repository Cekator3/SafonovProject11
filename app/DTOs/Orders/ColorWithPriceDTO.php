<?php

namespace App\DTOs\Orders;

/**
 * A subsystem for reading application data about colors
 * and their prices for using them when printing the particular model.
 */
final class ColorWithPriceDTO
{
    private int $id;
    private string $code = '';
    private float $price;

    public function __construct(int $id, string $code, float $price)
    {
        $this->id = $id;
        $this->code = $code;
        $this->price = $price;
    }

    /**
     * Returns the id of the color
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the color's rgb css code
     */
    public function getRgbCss() : string
    {
        return '#'.$this->code;
    }

    /**
     * Returns the price for using this color
     * when printing particular model
     */
    public function getPrice() : float
    {
        return $this->price;
    }
}
