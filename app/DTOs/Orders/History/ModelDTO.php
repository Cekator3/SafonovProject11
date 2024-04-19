<?php

namespace App\DTOs\Orders\History;

/**
 * A subsystem for reading application data about order's model.
 */
final class ModelDTO
{
    private int $ordered_model_id;
    private string $name;
    private int $amount;
    private float $price;
    private string $thumbnailFilename;
    private string $thumbnailUrl;

    public function __construct (int $ordered_model_id,
                                 string $name,
                                 int $amount,
                                 float $price,
                                 string $thumbnailFilename)
    {
        $this->ordered_model_id = $ordered_model_id;
        $this->name = $name;
        $this->amount = $amount;
        $this->price = $price;
        $this->thumbnailFilename = $thumbnailFilename;
    }

    /**
     * Returns the id of the ordered model.
     */
    public function getId() : int
    {
        return $this->ordered_model_id;
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
        return $this->price * $this->amount;
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
