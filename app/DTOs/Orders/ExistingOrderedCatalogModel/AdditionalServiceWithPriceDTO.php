<?php

namespace App\DTOs\Orders\ExistingOrderedCatalogModel;

/**
 * A subsystem for reading application data about additional services
 * and their prices for using them when printing the particular model.
 */
final class AdditionalServiceWithPriceDTO
{
    private int $id;
    private string $name = '';
    private string $description = '';
    private bool $isSelected;
    private string $previewImageFilename = '';
    private string $previewImageUrl = '';
    private float $price;

    /**
     * @param bool $isSelected indicates whether the user chose to use that
     * additional service to print the model
     */
    public function __construct(int $id,
                                string $name,
                                string $description,
                                bool $isSelected,
                                string $previewImageFilename,
                                float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->isSelected = $isSelected;
        $this->previewImageFilename = $previewImageFilename;
        $this->price = $price;
    }

    /**
     * Returns the id of the additional service
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the name of the additional service
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Returns the description of the additional service
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Returns true if user chose to use that color
     * to print the model
     */
    public function isSelected() : bool
    {
        return $this->isSelected;
    }

    /**
     * Returns the preview image URL of the additional service
     */
    public function getPreviewImageUrl() : string
    {
        return $this->previewImageUrl;
    }

    /**
     * Returns the price for using this additional service
     * when printing particular model
     */
    public function getPrice() : float
    {
        return $this->price;
    }

    /**
     * Returns the preview image filename of the additional service
     */
    public function getPreviewImageFilename() : string
    {
        return $this->previewImageFilename;
    }

    /**
     * Sets the URL of the preview image for the additional service.
     */
    public function setPreviewImageUrl(string $previewImageUrl) : void
    {
        $this->previewImageUrl = $previewImageUrl;
    }
}
