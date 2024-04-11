<?php

namespace App\Services\Admin\BaseModels;

use App\Errors\UserInputErrors;
use Illuminate\Http\UploadedFile;
use App\ViewModels\Admin\BaseModel\BaseModelSize;
use App\Errors\Admin\BaseModel\BaseModelUpdateErrors;
use App\Repositories\Images\BaseModelThumbnailRepository;
use App\Repositories\Admin\BaseModels\BaseModelRepository;
use App\ViewModels\Admin\BaseModel\BaseModelUpdateViewModel;
use App\Repositories\Images\BaseModelGalleryImagesRepository;
use App\Services\FileFormatValidation\ImageFormatValidationService;
use App\Services\Admin\BaseModels\UserInputValidation\BaseModelNameValidationService;
use App\Services\Admin\BaseModels\UserInputValidation\BaseModelSizeValidationService;
use App\Services\Admin\BaseModels\UserInputValidation\BaseModelDescriptionValidationService;

/**
 * Subsystem for updating stored information on base model.
 */
class BaseModelsUpdateService
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
            return;

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
            return;

        $imageValidator = new ImageFormatValidationService();
        $imageValidator->validate($image, $errors, 'previewImage');
    }

    private function validateUserInput(BaseModelUpdateViewModel $model,
                                       UserInputErrors $errors)
    {
        $nameValidator = new BaseModelNameValidationService();
        $descriptionValidator = new BaseModelDescriptionValidationService();

        $nameValidator->validate($model->name, $errors);
        $descriptionValidator->validate($model->description, $errors);
        $this->validateModelSizes($model->modelSizes, $errors);

        $this->validateThumbnail($model->thumbnail, $errors);
        $this->validateGalleryImages($model->newGalleryImages, $errors);
    }

    private function isExists(BaseModelUpdateViewModel $model) : bool
    {
        $models = new BaseModelRepository();

        return $models->isExist($model->name);
    }

    private function storeInformation(BaseModelUpdateViewModel $model,
                                      UserInputErrors $errors) : void
    {
        $updateErrors = new BaseModelUpdateErrors();
        $models = new BaseModelRepository();

        $models->update($model, $updateErrors);

        if ($updateErrors->hasAny())
        {
            if ($updateErrors->isAlreadyExist())
            {
                $errMessage = __('validation.unique', ['attribute' => 'name']);
                $errors->add('name', $errMessage);
            }
        }
    }

    private function replaceThumbnail(BaseModelUpdateViewModel $model) : void
    {
        $models = new BaseModelRepository();
        $thumbnails = new BaseModelThumbnailRepository();

        $model->thumbnailFilename = $models->getThumbnail($model->id);
        $thumbnails->replace($model->thumbnail, $model->thumbnailFilename);
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
     * @param int[] $ids Identifiers of gallery images to delete
     * @return string[] Array of images filenames
     */
    private function getGalleryImages(array $ids) : array
    {
        $models = new BaseModelRepository();

        return $models->getGalleryImages($ids);
    }

    /**
     * Tries to create a new base model from user's input.
     *
     * @param BaseModelUpdateViewModel $model User's input
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function update(BaseModelUpdateViewModel $model,
                           UserInputErrors $errors) : void
    {
        // 1. validate user's input
        $this->validateUserInput($model, $errors);

        if ($errors->hasAny())
            return;

        // 2. if needed replace thumbnail picture
        if (!empty($model->thumbnail))
        {
            $this->replaceThumbnail($model);
            assert($model->thumbnailFilename !== '', "Base model's thumbnail supposed to be stored but it has not.");
        }

        // 3. if needed store new gallery images
        if (!empty($model->newGalleryImages))
        {
            $this->storeGalleryImages($model->newGalleryImages, $model->newGalleryImagesFilenames);
            assert(count($model->newGalleryImages) === count($model->newGalleryImagesFilenames), 'Not all gallery images were saved');
        }

        // 4. if needed remove requested gallery images
        if (!empty($model->removedGalleryImages))
        {
            $images = $this->getGalleryImages($model->removedGalleryImages);
            $this->deleteGalleryImages($images);
        }

        // 5. update information about the base model
        $this->storeInformation($model, $errors);
    }
}
