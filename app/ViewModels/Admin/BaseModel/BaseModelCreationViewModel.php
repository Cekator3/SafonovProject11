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
    public string $description;

    /**
     * @var BaseModelSize[]
     */
    public array $modelSizes;

    public UploadedFile $thumbnail;
    public string $thumbnailFilename = '';

    /**
     * @var UploadedFile[]
     */
    public array $galleryImages;

    /**
     * @var string[]
     */
    public array $galleryImagesFilenames = [];


    /**
     * @var string $nameInputName the name of the input.
     * It will be used to add errors to the input.
     */
    public string $nameInputName;
    public string $descriptionInputName;
    public string $thumbnailInputName;
    public string $galleryImagesInputName;
}
