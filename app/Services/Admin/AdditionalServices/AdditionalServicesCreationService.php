<?php

namespace App\Services\Admin\AdditionalServices;
use App\Errors\UserInputErrors;
use App\Services\Admin\AdditionalServices\UserInputValidation\AdditionalServiceDescriptionValidationService;
use App\Services\Admin\AdditionalServices\UserInputValidation\AdditionalServiceNameValidationService;
use App\Services\FileFormatValidation\ImageFormatValidationService;
use App\ViewModels\Admin\AdditionalService\AdditionalServiceCreationViewModel;
use GuzzleHttp\Psr7\UploadedFile;

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

    private function checkIfExists(AdditionalServiceCreationViewModel $additionalService,
                                   bool &$result) : void
    {

    }

    private function storeInformation(AdditionalServiceCreationViewModel $additionalService,
                                      UserInputErrors $errors) : void
    {

    }

    private function storeThumbnailPicture(UploadedFile $thumbnailFile, string &$filename) : void
    {

    }

    private function deleteThumbnailPicture(string $filename) : void
    {

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
        $isExists = false;
        $this->checkIfExists($additionalService, $isExists);
        if ($isExists)
        {
            $errMessage = __('validation.exists');
            $errors->add('previewImage', $errMessage);
            return;
        }

        // 3. store thumbnail picture
        $this->storeThumbnailPicture($additionalService->thumbnailFile, $additionalService->thumbnailFilename);

        // 4. store additional service information
        $this->storeInformation($additionalService, $errors);

        if ($errors->hasAny())
        {
            $this->deleteThumbnailPicture($additionalService->thumbnailFilename);
            return;
        }

    }
}
