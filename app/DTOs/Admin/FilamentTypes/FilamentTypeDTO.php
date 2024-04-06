<?php

namespace App\DTOs\Admin\FilamentTypes;

use App\DTOs\Admin\PrintingTechnologies\PrintingTechnologyDTO;

/**
 * A subsystem for reading application data about the filament type
 */
class FilamentTypeDTO
{
    private int $id;
    private string $name = '';
    private string $description = '';
    private FilamentTypeCharacteristics $characteristics;
    /**
     * @var PrintingTechnologyDTO[]
     */
    private array $printingTechnologies;

    /**
     * @param PrintingTechnologyDTO[] $printingTechnologies
     */
    public function __construct(int $id,
                                string $name,
                                string $description,
                                FilamentTypeCharacteristics $characteristics,
                                array $printingTechnologies)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->characteristics = $characteristics;
        $this->printingTechnologies = $printingTechnologies;
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
        assert($this->name !== '', 'accessing not initialized property: $name');
        return $this->name;
    }

    /**
     * Returns the description of the filament type
     */
    public function getDescription() : string
    {
        assert($this->description !== '', 'accessing not initialized property: $description');
        return $this->description;
    }

    /**
     * Returns the printing technologies in which that filament type is used
     *
     * @return PrintingTechnologyDTO[]
     */
    public function getPrintingTechnologies() : array
    {
        return $this->printingTechnologies;
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
}
