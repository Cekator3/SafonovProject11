<?php

namespace App\DTOs\Orders;

/**
 * A subsystem for reading application data about
 * ordered models
 */
final class OrderedModelDTO
{
    private int $id;
    private int $amount;
    private PrintingTechnologyWithPriceDTO $printingTechnology;
    private FilamentTypeWithPriceDTO $filamentType;
    private ColorWithPriceDTO $color;
    private ModelSizeWithPriceDTO $modelSize;
    private AdditionalServiceWithPriceDTO $additionalService;
    private bool $isHoled;
    private bool $isParted;
    private float $priceForHoledType;
    private float $priceForSolidType;
    private float $priceForPartedType;
    private float $priceForNotPartedType;

    public function __construct(int $id,
                                int $amount,
                                PrintingTechnologyWithPriceDTO $printingTechnology,
                                FilamentTypeWithPriceDTO $filamentType,
                                ColorWithPriceDTO $color,
                                ModelSizeWithPriceDTO $modelSize,
                                AdditionalServiceWithPriceDTO $additionalService,
                                bool $isHoled,
                                bool $isParted,
                                float $priceForHoledType,
                                float $priceForSolidType,
                                float $priceForPartedType,
                                float $priceForNotPartedType)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->printingTechnology = $printingTechnology;
        $this->filamentType = $filamentType;
        $this->color = $color;
        $this->modelSize = $modelSize;
        $this->additionalService = $additionalService;
        $this->isHoled = $isHoled;
        $this->isParted = $isParted;
        $this->priceForHoledType = $priceForHoledType;
        $this->priceForSolidType = $priceForSolidType;
        $this->priceForPartedType = $priceForPartedType;
        $this->priceForNotPartedType = $priceForNotPartedType;
    }

    /**
     * Returns the id of the model in the user's order
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the amount of the model in the user's order
     */
    public function getAmount() : int
    {
        return $this->amount;
    }

    /**
     * Returns the printing technology of the model in the user's order
     */
    public function getPrintingTechnology() : PrintingTechnologyWithPriceDTO
    {
        return $this->printingTechnology;
    }

    /**
     * Returns the filament type of the model in the user's order
     */
    public function getFilamentType() : FilamentTypeWithPriceDTO
    {
        return $this->filamentType;
    }

    /**
     * Returns the color of the model in the user's order
     */
    public function getColor() : ColorWithPriceDTO
    {
        return $this->color;
    }

    /**
     * Returns the size of the model in the user's order
     */
    public function getModelSize() : ModelSizeWithPriceDTO
    {
        return $this->modelSize;
    }

    /**
     * Returns the additional service of the model in the user's order
     */
    public function getAdditionalService() : AdditionalServiceWithPriceDTO
    {
        return $this->additionalService;
    }

    /**
     * Returns true if the model is holed in the user's order
     */
    public function isHoled() : bool
    {
        return $this->isHoled;
    }

    /**
     * Returns true if the model is parted in the user's order
     */
    public function isParted() : bool
    {
        return $this->isParted;
    }

    /**
     * Returns the price to print holed version of this model.
     */
    public function getPriceForHoledType() : float
    {
        return $this->priceForHoledType;
    }

    /**
     * Returns the price to print solid version of this model.
     */
    public function getPriceForSolidType() : float
    {
        return $this->priceForSolidType;
    }

    /**
     * Returns the price to print parted version of this model.
     */
    public function getPriceForPartedType() : float
    {
        return $this->priceForPartedType;
    }

    /**
     * Returns the price to print not parted version of this model.
     */
    public function getPriceForNotPartedType() : float
    {
        return $this->priceForNotPartedType;
    }
}
