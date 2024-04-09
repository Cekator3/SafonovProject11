<?php

namespace App\DTOs\Admin\BaseModels\Prices;

/**
 * A subsystem for reading application data about printing technologies
 * and their prices for using them when printing the particular model.
 */
class PrintingTechnologyWithPriceDTO
{
    protected int $id;
    protected string $name;
    protected string $description;
    private float $price;

    public function __construct(int $id, string $name, string $description, float $price)
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
        assert($this->name !== '', 'accessing not initialized property: $name');
        return $this->name;
    }

    /**
     * Returns the description of the printing technology
     */
    public function getDescription() : string
    {
        assert($this->description !== '', 'accessing not initialized property: $description');
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
