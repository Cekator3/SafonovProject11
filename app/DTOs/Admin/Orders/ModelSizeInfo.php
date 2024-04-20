<?php

namespace App\DTOs\Admin\Orders;

/**
 * A subsystem for reading application data about the model's size (administrator)
 */
class ModelSizeInfo
{
    private int $multiplier;
    private int $length;
    private int $height;
    private int $width;

    public function __construct(int $multiplier, int $length, int $height, int $width)
    {
        $this->multiplier = $multiplier;
        $this->length = $length;
        $this->height = $height;
        $this->width = $width;
    }

    /**
     * Returns the model's size multiplier
     */
    public function getMultiplier() : int
    {
        return $this->multiplier;
    }

    /**
     * Returns the model's length
     */
    public function getLength() : int
    {
        return $this->length;
    }

    /**
     * Returns the model's width
     */
    public function getWidth() : int
    {
        return $this->width;
    }

    /**
     * Returns the model's height
     */
    public function getHeight() : int
    {
        return $this->height;
    }
}
