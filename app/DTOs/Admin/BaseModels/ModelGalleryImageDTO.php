<?php

namespace App\DTOs\Admin\BaseModels;

/**
 * A subsystem for reading application data about model's
 * gallery images.
 */
class ModelGalleryImageDTO
{
    private int $id;
    private string $filename;
    private string $url;

    public function __construct(int $id, string $filename)
    {
        $this->id = $id;
        $this->filename = $filename;
    }

    /**
     * Returns the id of the image
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the URL of the image
     */
    public function getUrl() : string
    {
        return $this->url;
    }



    /**
     * Returns the filename of the image (only to set the url later)
     */
    public function getFilename() : string
    {
        return $this->filename;
    }

    /**
     * Sets the URL of the image
     */
    public function setUrl(string $url) : void
    {
        assert(! isset($this->url), 'Trying to replace the URL: $url = ' . $url);
        $this->url = $url;
    }
}
