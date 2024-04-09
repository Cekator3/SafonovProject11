<?php

namespace App\DTOs\Admin\Models;

/**
 * A subsystem for reading application's data about model.
 */
class ModelDTO
{
    private int $id;
    private string $name;
    private string $description;
    private string $previewImageFilename;
    private string $previewImageUrl;
    /**
     * @var ModelGalleryImageDTO[]
     */
    private array $galleryImages;
    /**
     * @var ModelSizeDTO[]
     */
    private array $sizes;


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
     * Returns the gallery images of the model
     *
     * @return ModelGalleryImageDTO[]
     */
    public function getGalleryImages() : array
    {
        return $this->galleryImages;
    }

    /**
     * Returns existing size's of the model
     *
     * @return ModelSizeDTO[]
     */
    public function getSizes() : array
    {
        return $this->sizes;
    }
}
