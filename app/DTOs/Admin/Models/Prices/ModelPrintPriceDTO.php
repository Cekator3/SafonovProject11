<?php

namespace App\DTOs\Admin\Models\Prices;

/**
 * A subsystem for reading application's data about models print prices.
 */
class ModelPrintPriceDTO
{
    private int $id;
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
    private array $sizes;
    /**
     * @var AdditionalServiceWithPriceDTO[]
     */
    private array $additionalServices;
    private float $priceForHoledType;
    private float $priceForSolidType;
    private float $priceForPartedType;
    private float $priceForNotPartedType;

    /**
     * @param PrintingTechnologyWithPriceDTO[] $printingTechnologies
     * @param FilamentTypeWithPriceDTO[] $filamentTypes
     * @param ColorWithPriceDTO[] $colors
     * @param ModelSizeWithPriceDTO[] $sizes
     * @param AdditionalServiceWithPriceDTO[] $additionalServices
     */
    public function __construct(int $modelId,
                                array $printingTechnologies,
                                array $filamentTypes,
                                array $colors,
                                array $sizes,
                                array $additionalServices,
                                float $priceForHoledType,
                                float $priceForSolidType,
                                float $priceForPartedType,
                                float $priceForNotPartedType)
    {
        $this->id = $modelId;
        $this->printingTechnologies = $printingTechnologies;
        $this->filamentTypes = $filamentTypes;
        $this->colors = $colors;
        $this->sizes = $sizes;
        $this->additionalServices = $additionalServices;
        $this->priceForHoledType = $priceForHoledType;
        $this->priceForSolidType = $priceForSolidType;
        $this->priceForPartedType = $priceForPartedType;
        $this->priceForNotPartedType = $priceForNotPartedType;
    }

    /**
     * Returns the id of the model
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the printing technologies with their prices for using them
     * when printing this model.
     *
     * @return PrintingTechnologyWithPriceDTO[]
     */
    public function getPrintingTechnologies() : array
    {
        return $this->printingTechnologies;
    }

    /**
     * Returns the filament types with their prices for using
     * when printing this model.
     *
     * @return FilamentTypeWithPriceDTO[]
     */
    public function getFilamentTypes() : array
    {
        return $this->filamentTypes;
    }

    /**
     * Returns the colors with their prices for using
     * when printing this model.
     *
     * @return ColorWithPriceDTO[]
     */
    public function getColors() : array
    {
        return $this->colors;
    }

    /**
     * Returns the sizes with their prices for using
     * when printing this model.
     *
     * @return ModelSizeWithPriceDTO[]
     */
    public function getSizes() : array
    {
        return $this->sizes;
    }

    /**
     * Returns the additional services with their prices for using
     * when printing this model.
     *
     * @return AdditionalServiceWithPriceDTO[]
     */
    public function getAdditionalServices() : array
    {
        return $this->additionalServices;
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
