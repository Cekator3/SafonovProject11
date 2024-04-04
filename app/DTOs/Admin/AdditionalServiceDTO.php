<?php

namespace App\DTOs\Admin\AdditionalServices;

/**
 *
 */
class AdditionalServiceDTO
{
    private string $name = '';
    private string $description = '';
    private string $previewImageFilename = '';
    private string $previewImageUrl = '';

    public function __construct(string $name,
                                string $description,
                                string $previewImageFilename)
    {
        $this->name = $name;
        $this->description = $description;
        $this->previewImageFilename = $previewImageFilename;
    }

    public function getName() : string
    {
        assert($this->name !== '', 'accessing not initialized property: $name');
        return $this->name;
    }

    public function getDescription() : string
    {
        assert($this->description !== '', 'accessing not initialized property: $description');
        return $this->description;
    }

    public function getPreviewImageFilename() : string
    {
        assert($this->previewImageFilename !== '', 'accessing not initialized property: $previewImageFilename');
        return $this->previewImageFilename;
    }

    public function getPreviewImageUrl() : string
    {
        assert($this->previewImageUrl !== '', 'accessing not initialized property: $previewImageUrl');
        return $this->previewImageUrl;
    }

    public function setPreviewImageUrl(string $previewImageUrl) : void
    {
        $this->previewImageUrl = $previewImageUrl;
    }
}
