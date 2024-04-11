<?php

namespace App\Repositories\Images;

use Illuminate\Support\Facades\Config;

/**
 * A subsystem for interacting with stored base model gallery images.
 */
class BaseModelGalleryImagesRepository extends ImageRepository
{
    /**
     * Returns the path of directory where gallery images are stored
     */
    protected function getDirectory() : string
    {
        return 'public/'.Config::get('base_models.gallery.directory');
    }

    /**
     * Returns filename of default gallery image
     */
    protected function getDefaultPictureFilename() : string
    {
        return Config::get('base_models.gallery.default');
    }
}
