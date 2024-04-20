<?php

namespace App\DTOs\Admin\Orders;

/**
 * A subsystem for reading application data about the user's order and
 * it's ordered models (administrator)
 */
class OrderDTO
{
    private string $userEmail;
    private OrderInfo $orderInfo;
    private BaseModelInfo $modelInfo;
    private PrintingTechnologyInfo $printingTechnologyInfo;
    private FilamentTypeInfo $filamentTypeInfo;
    // Color's info
    private string $colorCode;
    // Model size's info
    private ModelSizeInfo $modelSizeInfo;

    public function __construct(string $userEmail,
                                OrderInfo $orderInfo,
                                BaseModelInfo $modelInfo,
                                PrintingTechnologyInfo $printingTechnologyInfo,
                                FilamentTypeInfo $filamentTypeInfo,
                                string $colorCode,
                                ModelSizeInfo $modelSizeInfo)
    {
        $this->userEmail = $userEmail;
        $this->orderInfo = $orderInfo;
        $this->modelInfo = $modelInfo;
        $this->printingTechnologyInfo = $printingTechnologyInfo;
        $this->filamentTypeInfo = $filamentTypeInfo;
        $this->colorCode = $colorCode;
        $this->modelSizeInfo = $modelSizeInfo;
    }

    /**
     * Returns the user's email
     */
    public function getUserEmail() : string
    {
        return $this->userEmail;
    }

    /**
     * Returns the id of the order
     */
    public function getOrderId() : int
    {
        return $this->orderInfo->getId();
    }

    /**
     * Returns the status of the order
     */
    public function getOrderStatus() : string
    {
        return $this->orderInfo->getStatus();
    }


    /**
     * Returns the order's payment date.
     */
    public function getOrderPaymentDate() : string
    {
        return $this->orderInfo->getPaymentDate();
    }

    /**
     * Returns the order's completion date.
     */
    public function getOrderCompletionDate() : string
    {
        return $this->orderInfo->getCompletionDate();
    }

    /**
     * Returns the id of the base model
     */
    public function getModelId() : int
    {
        return $this->modelInfo->getId();
    }

    /**
     * Returns the name of the base model
     */
    public function getModelName() : string
    {
        return $this->modelInfo->getName();
    }

    /**
     * Returns the filename of the base model's thumbnail (only needed to set the url later)
     */
    public function getModelThumbnailFilename() : string
    {
        return $this->modelInfo->getThumbnailFilename();
    }

    /**
     * Sets the URL of the base model's thumbnail
     */
    public function setModelThumbnailUrl(string $url) : void
    {
        $this->modelInfo->setThumbnailUrl($url);
    }

    /**
     * Returns the url of base model's thumbnail
     */
    public function getModelThumbnailUrl() : string
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
    public function getModelSizeMultiplier() : int
    {
        return $this->modelSizeInfo->getMultiplier();
    }

    /**
     * Returns the model's length
     */
    public function getModelLength() : int
    {
        return $this->modelSizeInfo->getLength();
    }

    /**
     * Returns the model's width
     */
    public function getModelWidth() : int
    {
        return $this->modelSizeInfo->getWidth();
    }

    /**
     * Returns the model's height
     */
    public function getModelHeight() : int
    {
        return $this->modelSizeInfo->getHeight();
    }
}
