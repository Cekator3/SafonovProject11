<?php

namespace App\DTOs\Orders\NewOrderedCatalogModel;

/**
 * A subsystem for reading application data about printing technologies
 * and their prices for using them when printing the particular model.
 */
final class PrintingTechnologyWithPriceDTO
{
    private int $id;
    private string $name;
    private string $description;
    /**
     * @var int[] $supportedFilamentTypesIds
     * Identifiers of filament types that can be used with that printing technology
     */
    private array $supportedFilamentTypesIds;
    private float $price;

    /**
     * @param int[] $supportedFilamentTypesIds
     * Identifiers of filament types that can be used with that printing technology
     */
    public function __construct(int $id,
                                string $name,
                                string $description,
                                array $supportedFilamentTypesIds,
                                float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->supportedFilamentTypesIds = $supportedFilamentTypesIds;
        $this->price = $price;
    }

    /**
     * Returns the id of the printing technology
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the name of the printing technology
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Returns the description of the printing technology
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Returns as JSON string identifiers of filament types that can be
     * used with that printing technology
     *
     * @return string
     */
    public function getSupportedFilamentTypesAsJSON() : string
    {
        return json_encode($this->supportedFilamentTypesIds);
    }

    /**
     * Returns the price for using this printing technology
     * when printing particular model
     */
    public function getPrice() : float
    {
        return $this->price;
    }
}
