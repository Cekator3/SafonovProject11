<?php

namespace App\DTOs\Admin\BaseModels;

/**
 * A subsystem for reading application data about model's
 * real life size.
 */
class ModelSizeDTO
{
    protected int $id;
    protected float $size_multiplier = 0.0;
    protected int $length = 0;
    protected int $width = 0;
    protected int $height = 0;

    public function __construct(int $id,
                                float $size_multiplier,
                                int $length,
                                int $width,
                                int $height)
    {
        $this->id = $id;
        $this->size_multiplier = $size_multiplier;
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;

        assert($this->size_multiplier > 0.0, 'model size multiplier must be greater than 0.0');
        assert($this->length > 0, 'model length must be greater than 0');
        assert($this->width > 0, 'model width must be greater than 0');
        assert($this->height > 0, 'model height must be greater than 0');
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
}
