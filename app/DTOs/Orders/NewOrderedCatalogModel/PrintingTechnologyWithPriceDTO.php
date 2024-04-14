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
     * Returns the price for using this printing technology
     * when printing particular model
     */
    public function getPrice() : float
    {
        return $this->price;
    }
}
