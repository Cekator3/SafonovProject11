<?php

namespace App\Services\FileFormatValidation;
use App\Errors\UserInputErrors;
use Illuminate\Http\UploadedFile;

/**
 * Subsystem, for checking whether the file input meets the image criteria,
 * according to the application requirements.
 */
class ImageFormatValidationService
{
    private function isImage(array|UploadedFile $file) : bool
    {
        return substr($file->getMimeType(), 0, 5) === 'image';
    }

    /**
     * Checks if the file input meets the image criteria
     *
     * @param array|UploadedFile $file File input
     * @param UserInputErrors $errors
     * Data structure, where discovered errors will be stored.
     */
    public function validate(array|UploadedFile $file, UserInputErrors $errors) : void
    {
        if (! $this->isImage($file))
        {
            $errMessage = __('validation.image', ['attribute' => 'image']);
            $errors->add('profile_picture', $errMessage);
        }
    }
}
