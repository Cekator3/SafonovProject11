<?php

namespace App\ViewModels\Admin\AdditionalService;

/**
 * class for transferring input
 * that was entered in an additional service update form
 * from interfaces (views)
 * to the application (services and repositories).
 */
class AdditionalServiceUpdateViewModel
{
    public int $id;
    public string $name;
    public string $description;
    public UploadedFile|null $thumbnailFile;
    public string $thumbnailFilename;
}
