<?php

namespace App\Services\Admin\AdditionalServices;
use App\Errors\Admin\AdditionalService\AdditionalServiceCreationErrors;
use App\Errors\UserInputErrors;
use Illuminate\Http\UploadedFile;
use App\Repositories\Admin\AdditionalServiceRepository;
use App\Repositories\Images\AdditionalServiceThumbnailRepository;
use App\Services\FileFormatValidation\ImageFormatValidationService;
use App\ViewModels\Admin\AdditionalService\AdditionalServiceCreationViewModel;
use App\Services\Admin\AdditionalServices\UserInputValidation\AdditionalServiceNameValidationService;
use App\Services\Admin\AdditionalServices\UserInputValidation\AdditionalServiceDescriptionValidationService;

/**
 * Subsystem for storing information about new additional service.
 */
class AdditionalServicesCreationService
{
    private function validateUserInput(AdditionalServiceCreationViewModel $additionalService,
                                       UserInputErrors $errors)
    {
        $nameValidator = new AdditionalServiceNameValidationService();
        $descriptionValidator = new AdditionalServiceDescriptionValidationService();
        $imageValidator = new ImageFormatValidationService();

        $nameValidator->validate($additionalService->name, $errors);
        $descriptionValidator->validate($additionalService->description, $errors);
        // Validate thumbnail (preview image)
        if ($additionalService->thumbnailFile !== null)
        {
            $imageValidator->validate($additionalService->thumbnailFile, $errors, 'previewImage');
        }
        else
        {
            $errMessage = __('validation.required', ['attribute' => 'preview image']);
            $errors->add('previewImage', $errMessage);
        }
    }

    private function isExists(AdditionalServiceCreationViewModel $additionalService) : bool
    {
        $additionalServices = new AdditionalServiceRepository();
        return $additionalServices->isExist($additionalService->name);
    }

    private function storeInformation(AdditionalServiceCreationViewModel $additionalService,
                                      UserInputErrors $errors) : void
    {
        $creationErrors = new AdditionalServiceCreationErrors();
        $additionalServices = new AdditionalServiceRepository();

        $additionalServices->add($additionalService, $creationErrors);

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
        $thumbnails = new AdditionalServiceThumbnailRepository();
        $thumbnails->add($thumbnailFile, $filename);
    }

    private function deleteThumbnailPicture(string $filename) : void
    {
        $thumbnails = new AdditionalServiceThumbnailRepository();
        $thumbnails->remove($filename);
    }

    /**
     * Tries to create a new additional service from user's input.
     *
     * @param AdditionalServiceCreationViewModel $additionalService
     * User's input about new additional service
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function add(AdditionalServiceCreationViewModel $additionalService,
                        UserInputErrors $errors) : void
    {
        // 1. validate user's input
        $this->validateUserInput($additionalService, $errors);

        if ($errors->hasAny())
            return;

        // 2. check if additional service already exists
        if ($this->isExists($additionalService))
        {
            $errMessage = __('validation.unique', ['attribute' => 'name']);
            $errors->add('name', $errMessage);
            return;
        }

        // 3. store thumbnail picture
        $this->storeThumbnailPicture($additionalService->thumbnailFile, $additionalService->thumbnailFilename);
        assert($additionalService->thumbnailFilename !== '', 'Picture supposed to be stored but it has not.');

        // 4. store additional service information
        $this->storeInformation($additionalService, $errors);

        if ($errors->hasAny())
        {
            $this->deleteThumbnailPicture($additionalService->thumbnailFilename);
            return;
        }
    }
}
