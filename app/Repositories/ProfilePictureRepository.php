<?php

namespace App\Repositories;

use Illuminate\Http\UploadedFile;

/**
 * A subsystem for interaction with users profile pictures.
 */
class ProfilePictureRepository
{
    /**
     * Returns the URL of the profile picture
     *
     * @return string The URL of the profile picture. If picture not found, returns empty string
     */
    public function get(string $filename) : string
    {
        //...
    }

    /**
     * Returns the URL of the default profile picture
     */
    public function getDefault() : string
    {
        //...
    }

    /**
     * Stores a profile picture
     *
     * @param UploadedFile|array $profilePicture
     * @param string $filename Filename of stored profile picture
     */
    public function store(UploadedFile|array $profilePicture, string &$filename) : void
    {
        //...
    }

    /**
     * Replaces profile picture
     */
    public function replace(string $filename) : void
    {
        //...
    }

    /**
     * Removes a profile picture
     */
    public function remove(string $filename) : void
    {
        //...
    }
}
