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

    public function __construct(string $userEmail,
                                OrderInfo $orderInfo,
                                BaseModelInfo $modelInfo)
    {
        $this->userEmail = $userEmail;
        $this->orderInfo = $orderInfo;
        $this->modelInfo = $modelInfo;
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
}
