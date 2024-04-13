<?php

namespace App\DTOs\Orders;

/**
 * A subsystem for reading application data about printing technologies
 * and their prices for using them when printing the particular model.
 */
final class PrintingTechnologyWithPriceDTO
{
    private int $id;
    private string $name;
    private string $description;
    private bool $isSelected;
    private float $price;

    /**
     * @param bool $isSelected indicates whether the user chose to use that
     * printing technology to print the model
     */
    public function __construct(int $id,
                                string $name,
                                string $description,
                                bool $isSelected,
                                float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->isSelected = $isSelected;
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
     * Returns true if user chose to use that printing technology
     * to print the model
     */
    public function isSelected() : bool
    {
        return $this->isSelected();
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
