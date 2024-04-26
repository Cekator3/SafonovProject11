<?php

namespace App\DTOs\Orders\History;

/**
 * A subsystem for reading application data about the base model (administrator)
 */
class BaseModelInfo
{
    private int $id;
    private string $name;
    private string $thumbnailFilename;
    private string $thumbnailUrl;

    public function __construct(int $id, string $name, string $thumbnailFilename)
    {
        $this->id = $id;
        $this->name = $name;
        $this->thumbnailFilename = $thumbnailFilename;
    }

    /**
     * Returns the id of the base model
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the name of the base model
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Returns the url of thumbnail's image
     */
    public function getThumbnailUrl() : string
    {
        return $this->thumbnailUrl;
    }



    /**
     * Returns the filename of the base model's thumbnail (only to set the url later)
     */
    public function getThumbnailFilename() : string
    {
        return $this->thumbnailFilename;
    }

    /**
     * Sets the URL of the base model's thumbnail
     */
    public function setThumbnailUrl(string $url) : void
    {
        $this->thumbnailUrl = $url;
    }
}
