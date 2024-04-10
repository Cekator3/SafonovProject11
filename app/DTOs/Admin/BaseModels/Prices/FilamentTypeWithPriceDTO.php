<?php

namespace App\DTOs\Admin\BaseModels\Prices;

use App\DTOs\Admin\FilamentTypes\FilamentTypeCharacteristics;

/**
 * A subsystem for reading application data about filament types
 * and their prices for using them when printing the particular model.
 */
class FilamentTypeWithPriceDTO
{
    protected int $id;
    protected string $name = '';
    protected string $description = '';
    protected FilamentTypeCharacteristics $characteristics;
    private float $price;

    public function __construct(int $id,
                                string $name,
                                string $description,
                                float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    /**
     * Returns the id of the filament type
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the name of the filament type
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Returns the description of the filament type
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Returns the price for using this filament type
     * when printing particular model
     */
    public function getPrice() : float
    {
        return $this->price;
    }
}
