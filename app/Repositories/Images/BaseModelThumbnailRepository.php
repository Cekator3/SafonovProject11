<?php

namespace App\Repositories\Images;

use Illuminate\Support\Facades\Config;

/**
 * A subsystem for interacting with stored base model thumbnails.
 */
class BaseModelThumbnailRepository extends ImageRepository
{
    /**
     * Returns the path of directory where thumbnails are stored
     */
    protected function getDirectory() : string
    {
        return 'public/'.Config::get('base_models.preview_image.directory');
    }

    /**
     * Returns filename of default thumbnail
     */
    protected function getDefaultPictureFilename() : string
    {
        return Config::get('base_models.preview_image.default');
    }
}
