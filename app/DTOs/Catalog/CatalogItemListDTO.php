<?php

namespace APP\DTOs\Catalog;

/**
 * A subsystem for reading application data specifically
 * to display a list of catalog items
 */
class CatalogItemListDTO
{
    private int $id;
    private string $name;
    private string $description;
    private string $previewImageFilename;
    private string $previewImageUrl;

    public function __construct(int $id,
                                string $name,
                                string $description,
                                string $previewImageFilename)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->previewImageFilename = $previewImageFilename;
    }

    /**
     * Returns the id of the model
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the name of the model
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Returns the description of the model
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Returns the preview image URL of the model
     */
    public function getPreviewImageUrl() : string
    {
        return $this->previewImageUrl;
    }



    /**
     * Returns the preview image filename of the model
     */
    public function getPreviewImageFilename() : string
    {
        return $this->previewImageFilename;
    }

    /**
     * Sets the URL of the preview image for the model.
     */
    public function setPreviewImageUrl(string $previewImageUrl) : void
    {
        assert(! isset($this->previewImageUrl), 'Trying to replace the URL: $previewImageUrl = ' . $previewImageUrl);
        $this->previewImageUrl = $previewImageUrl;
    }
}
