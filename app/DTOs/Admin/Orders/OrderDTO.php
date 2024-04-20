<?php

namespace App\DTOs\Admin\Orders;

use DateTime;
use App\Enums\OrderStatus;

/**
 * A subsystem for reading application data about the user's order and
 * it's ordered models (administrator)
 */
class OrderDTO
{
    // User's info
    private string $userEmail;
    // Order's info
    private OrderStatus $status;
    private DateTime $payedAt;
    private DateTime $completedAt;
    // model's info
    private int $modelId;
    private string $modelName;
    private string $modelThumbnailFilename;
    private string $modelThumbnailUrl;
    // Printing technology's info
    private int $printingTechnologyId;
    private string $printingTechnologyName;
    // Filament type's info
    private int $filamentTypeId;
    private string $filamentTypeName;
    // Color's info
    private string $colorCode;
    // Model size's info
    private int $modelSizeMultiplier;
    private int $modelSizeLength;
    private int $modelSizeHeight;
    private int $modelSizeWidth;

    public function __construct()
    {
        // ...
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
     * @return PrintingTechnologyNameOnlyDTO[]
     */
    public function getPrintingTechnologies() : array
    {
        return $this->printingTechnologies;
    }

    /**
     * Checks if filament type is used in printing technology
     *
     * @return bool
     */
    public function isUsedInPrintingTechnology(int $printingTechnologyId) : bool
    {
        foreach ($this->printingTechnologies as $printingTechnology)
        {
            if ($printingTechnology->getId() === $printingTechnologyId)
                return true;
        }
        return false;
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
