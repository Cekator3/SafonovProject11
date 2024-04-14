<?php

namespace App\DTOs\Orders\ExistingOrderedCatalogModel;

/**
 * A subsystem for reading application data required
 * to add a model from the catalogue to the user's order.
 *
 * A subsystem for reading the application data required
 * to modify the model from the catalogue in the user's order..
 */
final class ExistingOrderedCatalogModelDTO
{
    private int $id;
    private int $amount;
    /**
     * @var PrintingTechnologyWithPriceDTO[]
     */
    private array $printingTechnologies;
    /**
     * @var FilamentTypeWithPriceDTO[]
     */
    private array $filamentTypes;
    /**
     * @var ColorWithPriceDTO[]
     */
    private array $colors;
    /**
     * @var ModelSizeWithPriceDTO[]
     */
    private array $modelSizes;
    /**
     * @var AdditionalServiceWithPriceDTO[]
     */
    private array $additionalServices;
    private bool $isHoled;
    private bool $isParted;
    private float $priceForHoledType;
    private float $priceForSolidType;
    private float $priceForPartedType;
    private float $priceForNotPartedType;

    /**
     * @param PrintingTechnologyWithPriceDTO[] $printingTechnologies
     * @param FilamentTypeWithPriceDTO[] $filamentTypes
     * @param ColorWithPriceDTO[] $colors
     * @param ModelSizeWithPriceDTO[] $modelSizes
     * @param AdditionalServiceWithPriceDTO[] $additionalServices
     * @param bool $isHoled indicates whether user chose holed version of the model
     * @param bool $isParted indicates whether user chose parted version of the model
     */
    public function __construct(int $id,
                                int $amount,
                                array $printingTechnologies,
                                array $filamentTypes,
                                array $colors,
                                array $modelSizes,
                                array $additionalServices,
                                bool $isHoled,
                                bool $isParted,
                                float $priceForHoledType,
                                float $priceForSolidType,
                                float $priceForPartedType,
                                float $priceForNotPartedType)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->printingTechnology = $printingTechnologies;
        $this->filamentType = $filamentTypes;
        $this->color = $colors;
        $this->modelSize = $modelSizes;
        $this->additionalService = $additionalServices;
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
     * Returns the printing technologies with their prices for using them
     * when printing this model.
     *
     * @return PrintingTechnologyWithPriceDTO[]
     */
    public function getPrintingTechnology() : array
    {
        return $this->printingTechnologies;
    }

    /**
     * Returns the filament types with their prices for using them
     * when printing this model.
     *
     * @return FilamentTypeWithPriceDTO[]
     */
    public function getFilamentType() : array
    {
        return $this->filamentTypes;
    }

    /**
     * Returns the colors with their prices for using them
     * when printing this model.
     *
     * @return ColorWithPriceDTO[]
     */
    public function getColor() : array
    {
        return $this->colors;
    }

    /**
     * Returns the model's sizes with their prices for using them
     * to print this model.
     *
     * @return ModelSizeWithPriceDTO[]
     */
    public function getModelSize() : array
    {
        return $this->modelSizes;
    }

    /**
     * Returns the additional services with their prices for using them
     * to print this model.
     *
     * @return AdditionalServiceWithPriceDTO[]
     */
    public function getAdditionalService() : array
    {
        return $this->additionalServices;
    }

    /**
     * Returns true if user chose holed version of the model
     * Returns false if he chose solid version.
     */
    public function isHoled() : bool
    {
        return $this->isHoled;
    }

    /**
     * Returns true if user chose parted version of the model.
     * Returns false if he chose not parted version.
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
