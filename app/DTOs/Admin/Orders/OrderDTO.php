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
    private OrderInfo $orderInfo;
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

    public function __construct(string $userEmail,
                                OrderInfo $orderInfo)
    {
        $this->userEmail = $userEmail;
        $this->orderInfo = $orderInfo;
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
    public function getCompletionDate() : string
    {
        return $this->orderInfo->getCompletionDate();
    }
}
