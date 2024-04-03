<?php

namespace App\Repositories;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

/**
 * A subsystem for interaction with users profile pictures.
 */
class ProfilePictureRepository
{
    private const DIRECTORY = Config::get('users.profile_pictures.directory');

    private function getFilepath(string $filename) : string
    {
        return static::DIRECTORY.$filename;
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
    public function store(UploadedFile|string|array $profilePicture, string &$filename) : void
    {
        $filepath = Storage::putFile(static::DIRECTORY, $profilePicture);
        $filename = basename($filepath);
    }

    /**
     * Replaces profile picture
     */
    public function replace(UploadedFile|string|array $profilePicture, string $filename) : void
    {
        Storage::putFileAs(static::DIRECTORY, $profilePicture, $filename);
    }

    /**
     * Removes a profile picture
     */
    public function remove(string $filename) : void
    {
        Storage::delete($this->getFilepath($filename));
    }
}
