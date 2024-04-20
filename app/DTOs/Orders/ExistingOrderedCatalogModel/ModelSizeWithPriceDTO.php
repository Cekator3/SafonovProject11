<?php

namespace App\DTOs\Orders\ExistingOrderedCatalogModel;

/**
 * A subsystem for reading application data about models
 * real life sizes and their prices for using them when printing
 * this model.
 */
final class ModelSizeWithPriceDTO
{
    private int $id;
    private int $size_multiplier = 0;
    private int $length = 0;
    private int $width = 0;
    private int $height = 0;
    private bool $isSelected;
    private float $price;

    /**
     * @param bool $isSelected indicates whether the user chose to use that
     * model size to print the model
     */
    public function __construct(int $id,
                                bool $isSelected,
                                int $sizeMultiplier,
                                int $length,
                                int $width,
                                int $height,
                                float $price)
    {
        $this->id = $id;
        $this->isSelected = $isSelected;
        $this->size_multiplier = $sizeMultiplier;
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
        $this->price = $price;
    }

    /**
     * Returns model's size id
     */
    public function getId() : int
    {
        return $this->id;
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
     * Returns model's size multiplier
     */
    public function getMultiplier() : float
    {
        return $this->size_multiplier;
    }

    /**
     * Returns the length of the model
     */
    public function getLength() : int
    {
        return $this->length;
    }

    /**
     * Returns the width of the model
     */
    public function getWidth() : int
    {
        return $this->width;
    }

    /**
     * Returns the height of the model
     */
    public function getHeight() : int
    {
        return $this->height;
    }

    /**
     * Returns the price for using this model size for printing
     */
    public function getPrice() : float
    {
        return $this->price;
    }
}
