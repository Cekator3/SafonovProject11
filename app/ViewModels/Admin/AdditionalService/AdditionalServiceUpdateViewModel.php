<?php

namespace App\ViewModels\Admin\AdditionalService;

use Illuminate\Http\UploadedFile;

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

    public function isNeedToUpdateThumbnail() : bool
    {
        return $this->thumbnailFile !== null;
    }
}
