<?php

namespace App\Services\Admin\AdditionalServices;
use App\Errors\UserInputErrors;
use App\Repositories\Admin\AdditionalServiceRepository;
use App\Repositories\Images\AdditionalServiceThumbnailRepository;
use App\Services\FileFormatValidation\ImageFormatValidationService;
use App\Errors\Admin\AdditionalService\AdditionalServiceUpdateErrors;
use App\ViewModels\Admin\AdditionalService\AdditionalServiceUpdateViewModel;
use App\Services\Admin\AdditionalServices\UserInputValidation\AdditionalServiceNameValidationService;
use App\Services\Admin\AdditionalServices\UserInputValidation\AdditionalServiceDescriptionValidationService;

/**
 * Subsystem for updating stored information on additional service.
 */
class AdditionalServicesUpdateService
{
    private function validateUserInput(AdditionalServiceUpdateViewModel $additionalService,
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
    }

    private function replaceThumbnail(AdditionalServiceUpdateViewModel $additionalService) : void
    {
        $additionalServices = new AdditionalServiceRepository();
        $additionalService->thumbnailFilename = $additionalServices->getThumbnail($additionalService->id);

        $thumbnails = new AdditionalServiceThumbnailRepository();
        $thumbnails->replace($additionalService->thumbnailFile,
                             $additionalService->thumbnailFilename);
    }

    private function updateInformation(AdditionalServiceUpdateViewModel $additionalService,
                                       UserInputErrors $errors) : void
    {
        $updateErrors = new AdditionalServiceUpdateErrors();
        $additionalServices = new AdditionalServiceRepository();

        $additionalServices->update($additionalService, $updateErrors);

        if ($updateErrors->hasAny())
        {
            if ($updateErrors->isAlreadyExist())
            {
                $errMessage = __('validation.unique', ['attribute' => 'name']);
                $errors->add('name', $errMessage);
            }
        }
    }

    /**
     * Tries to update a additional service using user's input.
     *
     * @param AdditionalServiceUpdateViewModel $additionalService User's input
     * @param UserInputErrors $errors
     * User's inputs errors that prevented successful execution of the action.
     */
    public function update(AdditionalServiceUpdateViewModel $additionalService,
                           UserInputErrors $errors) : void
    {
        // 1. validate user's input
        $this->validateUserInput($additionalService, $errors);

        if ($errors->hasAny())
            return;

        // 2. store thumbnail picture
        if ($additionalService->isNeedToUpdateThumbnail())
        {
            $this->replaceThumbnail($additionalService);
            assert($additionalService->thumbnailFilename !== '', 'Picture supposed to be stored but it has not.');
        }

        // 3. update additional service information
        $this->updateInformation($additionalService, $errors);
    }
}
