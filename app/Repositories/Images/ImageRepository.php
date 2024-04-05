<?php

namespace App\Repositories\Images;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

/**
 * A subsystem for interacting with stored images files.
 */
abstract class ImageRepository
{
    /**
     * Returns the path of directory where pictures are stored
     */
    abstract protected function getDirectory() : string;

    /**
     * Returns filename of default picture
     */
    abstract protected function getDefaultPictureFilename() : string;

    /**
     * Returns the filepath of picture
     */
    private function getFilepath(string $filename) : string
    {
        return $this->getDirectory().$filename;
    }


    /**
     * Returns the URL of the picture
     *
     * @return string The URL of the picture. If not found returns empty string
     */
    public final function get(string $filename) : string
    {
        return Storage::url($this->getFilepath($filename));
    }

    /**
     * Returns the URL of the default picture
     */
    public final function getDefault() : string
    {
        $filename = Config::get('users.profile_pictures.default');
        return Storage::url($this->getFilepath($filename));
    }

    /**
     * Stores a picture
     *
     * @param UploadedFile|string|array $picture file
     * @param string $filename Variable in which the filename of the saved picture will be stored
     */
    public final function add(UploadedFile|string|array $picture, string|null &$filename) : void
    {
        $filepath = Storage::putFile($this->getDirectory(), $picture);
        $filename = basename($filepath);
    }

    /**
     * Replaces picture
     *
     * @param UploadedFile|string|array $picture file
     * @param string $filename Filename of picture to replace
     */
    public final function replace(UploadedFile|string|array $picture, string $filename) : void
    {
        Storage::putFileAs($this->getDirectory(), $picture, $filename);
    }

    /**
     * Removes a picture
     *
     * @param string $filename Filename of picture to delete
     */
    public final function remove(string $filename) : void
    {
        Storage::delete($this->getFilepath($filename));
    }
}
