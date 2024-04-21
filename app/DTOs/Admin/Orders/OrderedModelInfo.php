<?php

namespace App\DTOs\Admin\Orders;

/**
 * A subsystem for reading application data about the
 * ordered models (administrator)
 */
class OrderedModelInfo
{
    private BaseModelInfo $modelInfo;
    private PrintingTechnologyInfo $printingTechnologyInfo;
    private FilamentTypeInfo $filamentTypeInfo;
    // Color's info
    private string $colorCode;
    private ModelSizeInfo $modelSizeInfo;

    public function __construct(BaseModelInfo $modelInfo,
                                PrintingTechnologyInfo $printingTechnologyInfo,
                                FilamentTypeInfo $filamentTypeInfo,
                                string $colorCode,
                                ModelSizeInfo $modelSizeInfo)
    {
        $this->modelInfo = $modelInfo;
        $this->printingTechnologyInfo = $printingTechnologyInfo;
        $this->filamentTypeInfo = $filamentTypeInfo;
        $this->colorCode = $colorCode;
        $this->modelSizeInfo = $modelSizeInfo;
    }

    /**
     * Returns the id of the base model
     */
    public function getId() : int
    {
        return $this->modelInfo->getId();
    }

    /**
     * Returns the name of the base model
     */
    public function getName() : string
    {
        return $this->modelInfo->getName();
    }

    /**
     * Returns the filename of the base model's thumbnail (only needed to set the url later)
     */
    public function getThumbnailFilename() : string
    {
        return $this->modelInfo->getThumbnailFilename();
    }

    /**
     * Sets the URL of the base model's thumbnail
     */
    public function setThumbnailUrl(string $url) : void
    {
        $this->modelInfo->setThumbnailUrl($url);
    }

    /**
     * Returns the url of base model's thumbnail
     */
    public function getThumbnailUrl() : string
    {
        return $this->modelInfo->getThumbnailUrl();
    }

    /**
     * Returns the id of the printing technology
     */
    public function getPrintingTechnologyId() : int
    {
        return $this->printingTechnologyInfo->getId();
    }

    /**
     * Returns the name of the printing technology
     */
    public function getPrintingTechnologyName() : string
    {
        return $this->printingTechnologyInfo->getName();
    }


    /**
     * Returns the id of the filament type
     */
    public function getFilamentTypeId() : int
    {
        return $this->filamentTypeInfo->getId();
    }

    /**
     * Returns the name of the filament type
     */
    public function getFilamentTypeName() : string
    {
        return $this->filamentTypeInfo->getName();
    }

    /**
     * Returns the model's color as rgb CSS string
     */
    public function getColorAsRgbCSS() : string
    {
        return '#'.$this->colorCode;
    }

    /**
     * Returns the model's size multiplier
     */
    public function getSizeMultiplier() : int
    {
        return $this->modelSizeInfo->getMultiplier();
    }

    /**
     * Returns the model's length
     */
    public function getLength() : int
    {
        return $this->modelSizeInfo->getLength();
    }

    /**
     * Returns the model's width
     */
    public function getWidth() : int
    {
        return $this->modelSizeInfo->getWidth();
    }

    /**
     * Returns the model's height
     */
    public function getHeight() : int
    {
        return $this->modelSizeInfo->getHeight();
    }
}
