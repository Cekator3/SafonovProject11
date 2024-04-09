<?php

namespace App\DTOs\Admin\Models;

/**
 * A subsystem for reading application data specifically
 * to display a list of models.
 */
class ModelItemListDTO
{
    private int $id;
    private string $name = '';
    private string $previewImageFilename = '';
    private string $previewImageUrl = '';

    public function __construct(int $id, string $name, string $previewImageFilename)
    {
        $this->id = $id;
        $this->name = $name;
        $this->previewImageFilename = $previewImageFilename;
    }

    /**
     * Returns the id of the model
     */
    public function getId() : int
    {
        assert($this->id !== -1, 'accessing not initialized property: $id');
        return $this->id;
    }

    /**
     * Returns the name of the model
     */
    public function getName() : string
    {
        assert($this->name !== '', 'accessing not initialized property: $name');
        return $this->name;
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
     * Returns the preview image filename of the additional service
     */
    public function getPreviewImageFilename() : string
    {
        assert($this->previewImageFilename !== '', 'accessing not initialized property: $previewImageFilename');
        return $this->previewImageFilename;
    }

    /**
     * Sets the URL of the preview image for the additional service.
     */
    public function setPreviewImageUrl(string $previewImageUrl) : void
    {
        assert($this->previewImageUrl === '', "Trying to replace the URL {$this->previewImageUrl} with {$previewImageUrl} " . '($previewImageUrl).');
        $this->previewImageUrl = $previewImageUrl;
    }
}
