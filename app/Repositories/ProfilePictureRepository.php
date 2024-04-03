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
     */
    public function get(string $filename) : string
    {
        //...
    }

    /**
     * Stores a profile picture
     */
    public function store(UploadedFile $profilePicture, string &$filename) : void
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
