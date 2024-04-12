<?php

namespace App\ViewModels\Admin\BaseModel;

use Illuminate\Http\UploadedFile;

/**
 * class for transferring input
 * that was entered in an filament type update form
 * from interfaces (views)
 * to the application (services and repositories).
 */
class BaseModelUpdateViewModel
{
    public int $id;
    public string $name;
    public string $description;
    /**
     * @var BaseModelSize[]
     */
    public array $modelSizes;
    public UploadedFile $thumbnail;
    public string $thumbnailFilename;
    /**
     * @var UploadedFile[]
     */
    public array $newGalleryImages;
    /**
     * @var string[]
     */
    public array $newGalleryImagesFilenames;
    /**
     * Identifiers of removed gallery images
     * @var int[]
     */
    public array $removedGalleryImages;


    /**
     * @var string $nameInputName the name of the input.
     * It will be used to add errors to the input.
     */
    public string $nameInputName;
    public string $descriptionInputName;
    public string $thumbnailInputName;
    public string $galleryImagesInputName;
}
