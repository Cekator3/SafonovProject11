<?php

namespace App\DTOs\Orders\ExistingOrderedCatalogModel;

/**
 * A subsystem for reading application data about colors
 * and their prices for using them when printing the particular model.
 */
final class ColorWithPriceDTO
{
    private int $id;
    private string $code = '';
    private bool $isSelected;
    private float $price;

    /**
     * @param bool $isSelected indicates whether the user chose to use that
     * color to print the model
     */
    public function __construct(int $id, string $code, bool $isSelected, float $price)
    {
        $this->id = $id;
        $this->code = $code;
        $this->isSelected = $isSelected;
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
     * Returns true if user chose to use that color
     * to print the model
     */
    public function isSelected() : bool
    {
        return $this->isSelected;
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
