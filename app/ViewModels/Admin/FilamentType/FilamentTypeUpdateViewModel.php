<?php

namespace App\ViewModels\Admin\FilamentType;

/**
 * class for transferring input
 * that was entered in an additional service update form
 * from interfaces (views)
 * to the application (services and repositories).
 */
class FilamentTypeUpdateViewModel
{
    public int $id;
    public string $name;
    public string $description;
    /**
     * @var int[]
     */
    public array $printingTechnologiesIds;
    public int $strength;
    public int $hardness;
    public int $impactResistance;
    public int $durability;
    public int $minWorkTemperature;
    public int $maxWorkTemperature;
    public bool $food_contact_allowed;
}
