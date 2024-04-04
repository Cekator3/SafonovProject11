<?php

namespace App\Repositories\Images;

use Illuminate\Support\Facades\Config;

/**
 * A subsystem for interacting with users stored profile pictures files.
 */
class ProfilePictureRepository extends ImagesRepository
{
    /**
     * Returns the filepath of profile picture
     */
    protected function getFilepath(string $filename) : string
    {
        return $this->getDirectory().$filename;
    }

    /**
     * Returns the path of directory where profile pictures are stored
     */
    protected function getDirectory() : string
    {
        return 'public/'.Config::get('users.profile_pictures.directory');
    }

    /**
     * Returns filename of default profile picture
     */
    protected function getDefaultPictureFilename() : string
    {
        return Config::get('users.profile_pictures.default');
    }
}
