<?php

namespace App\ViewModels\Admin\BaseModel;
use Illuminate\Http\UploadedFile;

/**
 * class for transferring input
 * that was entered in an filament type creation form
 * from interfaces (views)
 * to the application (services and repositories).
 */
class BaseModelCreationViewModel
{
    public string $name;
    /**
     * @var string $nameInputName the name of the input.
     * It will be used to add errors to the input.
     */
    public string $nameInputName;

    public string $description;
    /**
     * @var string $descriptionInputName the name of the input.
     * It will be used to add errors to the input.
     */
    public string $descriptionInputName;

    /**
     * @var BaseModelSize[]
     */
    public array $modelSizes;

    public UploadedFile $thumbnail;
    public string $thumbnailFilename;
    /**
     * @var string $thumbnailInputName the name of the input.
     * It will be used to add errors to the input.
     */
    public string $thumbnailInputName;

    /**
     * @var UploadedFile[]
     */
    public array $galleryImages;
    /**
     * @var string $galleryImagesInputName the name of the input.
     * It will be used to add errors to the input.
     */
    public string $galleryImagesInputName;

    /**
     * @var string[]
     */
    public array $galleryImagesFilenames;
}
