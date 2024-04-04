<?php

namespace App\DTOs\Admin;

/**
 * A subsystem for reading application data about additional services
 */
class AdditionalServiceDTO
{
    private int $id;
    private string $name = '';
    private string $description = '';
    private string $previewImageFilename = '';
    private string $previewImageUrl = '';

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
     * Returns the id of the additional service
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Returns the name of the additional service
     */
    public function getName() : string
    {
        assert($this->name !== '', 'accessing not initialized property: $name');
        return $this->name;
    }

    /**
     * Returns the description of the additional service
     */
    public function getDescription() : string
    {
        assert($this->description !== '', 'accessing not initialized property: $description');
        return $this->description;
    }

    /**
     * Returns the preview image filename of the additional service
     */
    public function getPreviewImageFilename() : string
    {
        assert($this->previewImageFilename !== '', 'accessing not initialized property: $previewImageFilename');
        return $this->previewImageFilename;
    }

    /**
     * Returns the preview image URL of the additional service
     */
    public function getPreviewImageUrl() : string
    {
        assert($this->previewImageUrl !== '', 'accessing not initialized property: $previewImageUrl');
        return $this->previewImageUrl;
    }

    /**
     * Sets the URL of the preview image for the additional service.
     */
    public function setPreviewImageUrl(string $previewImageUrl) : void
    {
        assert($this->previewImageUrl === '', 'Trying to replace the URL: $previewImageUrl');
        $this->previewImageUrl = $previewImageUrl;
    }
}
