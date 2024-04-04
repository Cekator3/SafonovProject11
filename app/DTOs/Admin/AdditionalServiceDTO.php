<?php

namespace App\DTOs\Admin\AdditionalServices;

class AdditionalServiceDTO
{
    private string $name;
    private string $description;
    private string $previewImageFilename;
    private string $previewImageUrl;

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
        return $this->name;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function getPreviewImageFilename() : string
    {
        return $this->previewImageFilename;
    }

    public function getPreviewImageUrl() : string
    {
        return $this->previewImageUrl;
    }

    public function setPreviewImageUrl(string $previewImageUrl) : void
    {
        $this->previewImageUrl = $previewImageUrl;
    }
}
