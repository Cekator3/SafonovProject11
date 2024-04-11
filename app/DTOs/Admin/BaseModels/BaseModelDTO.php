<?php

namespace App\DTOs\Admin\BaseModels;

/**
 * A subsystem for reading application's data about model.
 */
class BaseModelDTO
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
     * @param ModelGalleryImageDTO[] $galleryImages
     * @param ModelSizeDTO[] $sizes
     */
    public function __construct(int $id,
                                string $name,
                                string $description,
                                string $previewImageFilename,
                                array $galleryImages,
                                array $sizes)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->previewImageFilename = $previewImageFilename;
        $this->galleryImages = $galleryImages;
        $this->sizes = $sizes;
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
