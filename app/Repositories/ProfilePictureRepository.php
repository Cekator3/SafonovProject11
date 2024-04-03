<?php

namespace App\Repositories;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

/**
 * A subsystem for interacting with users profile pictures.
 */
class ProfilePictureRepository
{
    private function getFilepath(string $filename) : string
    {
        return $this->getDirectory().$filename;
    }

    private function getDirectory() : string
    {
        return 'public/'.Config::get('users.profile_pictures.directory');
    }

    /**
     * Returns the URL of the profile picture
     *
     * @return string The URL of the profile picture. If picture not found, returns empty string
     */
    public function get(string $filename) : string
    {
        return Storage::url($this->getFilepath($filename));
    }

    /**
     * Returns the URL of the default profile picture
     */
    public function getDefault() : string
    {
        $filename = Config::get('users.profile_pictures.default');
        return Storage::url($this->getFilepath($filename));
    }

    /**
     * Stores a profile picture
     *
     * @param UploadedFile|string|array $profilePicture
     * @param string $filename Variable in which the name of the saved file will be stored
     */
    public function add(UploadedFile|string|array $profilePicture, string|null &$filename) : void
    {
        $filepath = Storage::putFile($this->getDirectory(), $profilePicture);
        $filename = basename($filepath);
    }

    /**
     * Replaces profile picture
     */
    public function replace(UploadedFile|string|array $profilePicture, string $filename) : void
    {
        Storage::putFileAs($this->getDirectory(), $profilePicture, $filename);
    }

    /**
     * Removes a profile picture
     */
    public function remove(string $filename) : void
    {
        Storage::delete($this->getFilepath($filename));
    }
}
