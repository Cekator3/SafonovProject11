<?php

namespace App\DTOs\Orders\ShoppingCart;

/**
 * A subsystem for reading application data about order's model.
 */
final class ModelDTO
{
    private int $orderedModelId;
    private string $name;
    private int $amount;
    private float $price;
    private string $thumbnailFilename;
    private string $thumbnailUrl;

    public function __construct (int $orderedModelId,
                                 string $name,
                                 int $amount,
                                 float $price,
                                 string $thumbnailFilename)
    {
        $this->orderedModelId = $orderedModelId;
        $this->name = $name;
        $this->amount = $amount;
        $this->price = $price;
        $this->thumbnailFilename = $thumbnailFilename;
    }

    /**
     * Returns the id of the model in order.
     */
    public function getId() : int
    {
        return $this->orderedModelId;
    }

    /**
     * Returns the name of the model.
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Returns the preview image URL of the model
     */
    public function getThumbnailUrl() : string
    {
        return $this->thumbnailUrl;
    }

    /**
     * Returns the amount of the model.
     */
    public function getAmount() : int
    {
        return $this->amount;
    }

    /**
     * Returns the total price of the model.
     */
    public function getPrice() : float
    {
        return $this->price;
    }



    /**
     * Returns the preview image filename of the model
     */
    public function getThumbnailFilename() : string
    {
        return $this->thumbnailFilename;
    }

    /**
     * Sets the URL of the thumbnail for the model.
     */
    public function setThumbnailUrl(string $thumbnailUrl) : void
    {
        assert(! isset($this->thumbnailUrl), 'Trying to replace the URL: $thumbnailUrl = ' . $thumbnailUrl);
        $this->thumbnailUrl = $thumbnailUrl;
    }
}
