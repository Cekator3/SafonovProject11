<?php

namespace App\Services\Admin\BaseModels;

use App\Errors\UserInputErrors;
use App\Repositories\Images\BaseModelGalleryImagesRepository;
use Illuminate\Http\UploadedFile;
use App\ViewModels\Admin\BaseModel\BaseModelSize;
use App\Errors\Admin\BaseModel\BaseModelCreationErrors;
use App\Repositories\Images\BaseModelThumbnailRepository;
use App\Repositories\Admin\BaseModels\BaseModelRepository;
use App\ViewModels\Admin\BaseModel\BaseModelCreationViewModel;
use App\Services\FileFormatValidation\ImageFormatValidationService;
use App\Services\Admin\BaseModels\UserInputValidation\BaseModelNameValidationService;
use App\Services\Admin\BaseModels\UserInputValidation\BaseModelSizeValidationService;
use App\Services\Admin\BaseModels\UserInputValidation\BaseModelDescriptionValidationService;

/**
 * Subsystem for storing information about new base models
 */
class BaseModelsCreationService
{
    /**
     * @param BaseModelSize[]|null $sizes
     */
    private function validateModelSizes(array|null $sizes, UserInputErrors $errors) : void
    {
        if (empty($sizes))
        {
            $errMessage = __('validation.required', ['attribute' => 'model size']);
            $errors->add('model-sizes[][multiplier]', $errMessage);
            return;
        }

        $sizeValidator = new BaseModelSizeValidationService();
        foreach ($sizes as $size)
        {
            $sizeValidator->validate($size, $errors);
            if ($errors->hasAny())
                return;
        }
    }

    /**
     * @param UploadedFile[]|null $images
     */
    private function validateGalleryImages(array|null $images, UserInputErrors $errors) : void
    {
        if (empty($images))
        {
            $errMessage = __('validation.required', ['attribute' => 'gallery image']);
            $errors->add('previewImage', $errMessage);
            return;
        }

        $imageValidator = new ImageFormatValidationService();
        foreach ($images as $image)
        {
            $imageValidator->validate($image, $errors, 'galleryImages');
            if ($errors->hasAny())
                return;
        }
    }

    private function validateThumbnail(UploadedFile|null $image, UserInputErrors $errors) : void
    {
        if ($image === null)
        {
            $errMessage = __('validation.required', ['attribute' => 'preview image']);
            $errors->add('previewImage', $errMessage);
            return;
        }

        $imageValidator = new ImageFormatValidationService();
        $imageValidator->validate($image, $errors, 'previewImage');
    }

    private function validateUserInput(BaseModelCreationViewModel $model,
                                       UserInputErrors $errors)
    {
        $nameValidator = new BaseModelNameValidationService();
        $descriptionValidator = new BaseModelDescriptionValidationService();

        $nameValidator->validate($model->name, $errors);
        $descriptionValidator->validate($model->description, $errors);
        $this->validateModelSizes($model->modelSizes, $errors);

        $this->validateThumbnail($model->thumbnail, $errors);
        $this->validateGalleryImages($model->galleryImages, $errors);
    }

    private function isExists(BaseModelCreationViewModel $model) : bool
    {
        $models = new BaseModelRepository();

        return $models->isExist($model->name);
    }

    private function storeInformation(BaseModelCreationViewModel $model,
                                      UserInputErrors $errors) : void
    {
        $creationErrors = new BaseModelCreationErrors();
        $models = new BaseModelRepository();

        $models->add($model, $creationErrors);

        if ($creationErrors->hasAny())
        {
            if ($creationErrors->isAlreadyExist())
            {
                $errMessage = __('validation.unique', ['attribute' => 'name']);
                $errors->add('name', $errMessage);
            }
        }
    }

    private function storeThumbnailPicture(UploadedFile $thumbnailFile, string &$filename) : void
    {
        $thumbnails = new BaseModelThumbnailRepository();

        $thumbnails->add($thumbnailFile, $filename);
    }

    private function deleteThumbnailPicture(string $filename) : void
    {
        $thumbnails = new BaseModelThumbnailRepository();

        $thumbnails->remove($filename);
    }

    /**
     * @param UploadedFile[] $images
     * @param string[] $filenames
     */
    private function storeGalleryImages(array $images, array &$filenames) : void
    {
        $filenames = [];
        $gallery = new BaseModelGalleryImagesRepository();

        foreach ($images as $image)
        {
            $filename = '';
            $gallery->add($image, $filename);

            $filenames []= $filename;
        }
    }

    /**
     * @param string[] $filenames
     */
    private function deleteGalleryImages(array $filenames) : void
    {
        $gallery = new BaseModelGalleryImagesRepository();

        foreach ($filenames as $filename)
            $gallery->remove($filename);
    }

    /**
     * Tries to create a new base model from user's input.
     *
     * @param BaseModelCreationViewModel $model
     * User's input about new base model
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function add(BaseModelCreationViewModel $model,
                        UserInputErrors $errors) : void
    {
        // 1. validate user's input
        $this->validateUserInput($model, $errors);

        if ($errors->hasAny())
            return;

        // 2. check if base model already exists
        if ($this->isExists($model))
        {
            $errMessage = __('validation.unique', ['attribute' => 'name']);
            $errors->add('name', $errMessage);
            return;
        }

        // 3. store thumbnail picture
        $this->storeThumbnailPicture($model->thumbnail, $model->thumbnailFilename);
        assert($model->thumbnailFilename !== '', 'Picture supposed to be stored but it has not.');

        // 4. store gallery images
        $this->storeGalleryImages($model->galleryImages, $model->galleryImagesFilenames);
        assert(count($model->galleryImages) === count($model->galleryImagesFilenames), 'Not all gallery images were saved');

        // 5. save information about new base model
        $this->storeInformation($model, $errors);

        if ($errors->hasAny())
        {
            // Revert all changes
            $this->deleteThumbnailPicture($model->thumbnailFilename);
            $this->deleteGalleryImages($model->galleryImagesFilenames);
            return;
        }
    }
}
