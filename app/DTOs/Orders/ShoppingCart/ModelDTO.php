<?php

namespace App\DTOs\Orders\ShoppingCart;

/**
 * A subsystem for reading application data about order's model.
 */
final class ModelDTO
{
    private int $id;
    private string $name;
    private int $amount;
    private float $totalPrice;
    private string $thumbnailFilename;
    private string $thumbnailUrl;

    public function __construct (int $id,
                                 string $name,
                                 int $amount,
                                 float $totalPrice,
                                 string $thumbnailFilename)
    {
        $this->id = $id;
        $this->name = $name;
        $this->amount = $amount;
        $this->totalPrice = $totalPrice;
        $this->thumbnailFilename = $thumbnailFilename;
    }

    /**
     * Returns the id of the model.
     */
    public function getId() : int
    {
        return $this->id;
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
    public function getTotalPrice() : float
    {
        return $this->totalPrice;
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
        assert(! isset($this->previewImageUrl), 'Trying to replace the URL: $thumbnailUrl = ' . $thumbnailUrl);
        $this->previewImageUrl = $thumbnailUrl;
    }
}
