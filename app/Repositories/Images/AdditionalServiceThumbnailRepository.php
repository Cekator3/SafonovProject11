<?php

namespace App\Repositories\Images;

use Illuminate\Support\Facades\Config;

/**
 * A subsystem for interacting with stored additional service thumbnails.
 */
class AdditionalServiceThumbnailRepository extends ImageRepository
{
    /**
     * Returns the path of directory where thumbnails are stored
     */
    protected function getDirectory() : string
    {
        return 'public/'.Config::get('additional_services.preview_image.directory');
    }

    /**
     * Returns filename of default thumbnail
     */
    protected function getDefaultPictureFilename() : string
    {
        return Config::get('additional_services.preview_image.default');
    }
}
