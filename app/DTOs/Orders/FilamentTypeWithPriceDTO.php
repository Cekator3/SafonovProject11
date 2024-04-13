<?php

namespace App\DTOs\Orders;
use App\DTOs\Admin\FilamentTypes\FilamentTypeCharacteristics;

/**
 * A subsystem for reading application data about filament types
 * and their prices for using them when printing the particular model.
 */
final class FilamentTypeWithPriceDTO
{
    private int $id;
    private string $name = '';
    private string $description = '';
    private FilamentTypeCharacteristics $characteristics;
    private float $price;

    public function __construct(int $id,
                                string $name,
                                string $description,
                                FilamentTypeCharacteristics $characteristics,
                                float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->characteristics = $characteristics;
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
     * Returns the strength rate of the filament type
     */
    public function getStrength() : int
    {
        return $this->characteristics->getStrength();
    }

    /**
     * Returns the hardness rate of the filament type
     */
    public function getHardness() : int
    {
        return $this->characteristics->getHardness();
    }

    /**
     * Returns the impact resistance rate of the filament type
     */
    public function getImpactResistance() : int
    {
        return $this->characteristics->getImpactResistance();
    }

    /**
     * Returns the durability rate of the filament type
     */
    public function getDurability() : int
    {
        return $this->characteristics->getDurability();
    }

    /**
     * Returns the min work temperature of the filament type
     */
    public function getMinWorkTemperature() : int
    {
        return $this->characteristics->getMinWorkTemperature();
    }

    /**
     * Returns the max work temperature of the filament type
     */
    public function getMaxWorkTemperature() : int
    {
        return $this->characteristics->getMaxWorkTemperature();
    }

    /**
     * Returns true if food contact is allowed for that filament type.
     */
    public function isFoodContactAllowed() : bool
    {
        return $this->characteristics->isFoodContactAllowed();
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
