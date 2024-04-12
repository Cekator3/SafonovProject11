<?php

namespace App\DTOs\Admin\BaseModels\Prices;

/**
 * A subsystem for reading application data about models
 * real life sizes and their prices for using them when printing
 * this model.
 */
class ModelSizeWithPriceDTO
{
    protected int $id;
    protected int $size_multiplier = 0;
    protected int $length = 0;
    protected int $width = 0;
    protected int $height = 0;
    private float $price;

    public function __construct(int $id,
                                float $sizeMultiplier,
                                int $length,
                                int $width,
                                int $height,
                                float $price)
    {
        $this->id = $id;
        $this->size_multiplier = $sizeMultiplier;
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
        $this->price = $price;

        assert($this->size_multiplier > 0.0, 'model size multiplier must be greater than 0.0');
        assert($this->length > 0, 'model length must be greater than 0');
        assert($this->width > 0, 'model width must be greater than 0');
        assert($this->height > 0, 'model height must be greater than 0');
        assert($this->price > 0, "price for model''s size must be greater than 0");
    }

    /**
     * Returns model's size id
     */
    public function getId() : int
    {
        return $this->id;
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
