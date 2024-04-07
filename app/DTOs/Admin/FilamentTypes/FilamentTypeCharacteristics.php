<?php

namespace App\DTOs\Admin\FilamentTypes;

class FilamentTypeCharacteristics
{
    private int $strength;
    private int $hardness;
    private int $impactResistance;
    private int $durability;
    private int $minWorkTemperature;
    private int $maxWorkTemperature;
    private bool $food_contact_allowed;

    public function __construct(int $strength,
                                int $hardness,
                                int $impactResistance,
                                int $durability,
                                int $minWorkTemperature,
                                int $maxWorkTemperature,
                                bool $food_contact_allowed)
    {
        $this->strength = $strength;
        $this->hardness = $hardness;
        $this->impactResistance = $impactResistance;
        $this->durability = $durability;
        $this->minWorkTemperature = $minWorkTemperature;
        $this->maxWorkTemperature = $maxWorkTemperature;
        $this->food_contact_allowed = $food_contact_allowed;
    }

    public function getStrength() : int
    {
        return $this->strength;
    }

    public function getHardness() : int
    {
        return $this->hardness;
    }

    public function getImpactResistance() : int
    {
        return $this->impactResistance;
    }

    public function getDurability() : int
    {
        return $this->durability;
    }

    public function getMinWorkTemperature() : int
    {
        return $this->minWorkTemperature;
    }

    public function getMaxWorkTemperature() : int
    {
        return $this->maxWorkTemperature;
    }

    public function isFoodContactAllowed() : bool
    {
        return $this->food_contact_allowed;
    }
}
