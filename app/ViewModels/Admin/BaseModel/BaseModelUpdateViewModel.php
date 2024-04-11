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
    public string $name;
    public string $description;
    /**
     * @var BaseModelSize[]
     */
    public array $modelSizes;
    public UploadedFile $thumbnail;
    /**
     * @var UploadedFile[]
     */
    public array $newGalleryImages;
    /**
     * Identifiers of removed gallery images
     * @var int[]
     */
    public array $removedGalleryImages;
}
