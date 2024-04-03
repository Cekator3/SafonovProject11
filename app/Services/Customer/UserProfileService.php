<?php

namespace App\Services\Customer;

use App\Errors\Customer\UserProfileUpdateErrors;
use App\Errors\UserInputErrors;
use App\Repositories\ProfilePictureRepository;
use App\Repositories\Users\CustomerProfileRepository;
use App\Services\UserCredentialsValidation\FormatValidation\PasswordFormatValidationService;
use Illuminate\Http\UploadedFile;
use App\ViewModels\Customer\UserProfileViewModel;

/**
 * Subsystem for updating user's profile information.
 */
class UserProfileService
{
    private function isImage(UploadedFile|array $file)
    {
        return substr($file->getMimeType(), 0, 5) === 'image';
    }

    private function validateImageInput(UserProfileViewModel|null $userProfile,
                                        UserInputErrors $errors) : void
    {
        if($this->isImage($userProfile->profilePicture))
            return;

        $errMessage = __('validation.image', ['attribute' => 'image']);
        $errors->add('profile_picture', $errMessage);
    }

    private function validateInput(UserProfileViewModel $userProfile,
                                   UserInputErrors $errors) : void
    {
        if ($userProfile->newPassword !== '')
            PasswordFormatValidationService::validatePassword($userProfile->newPassword, $errors, $userProfile->newPasswordConfirmation, true);

        if ($userProfile->profilePicture !== null)
            $this->validateImageInput($userProfile, $errors);
    }

    private function storeNewProfilePicture(UploadedFile|array $picture,
                                              string|null &$filename) : void
    {
        $profilePictures = new ProfilePictureRepository();
        $profilePictures->add($picture, $filename);
    }

    private function deleteOldProfilePicture(string $oldProfilePictureFilename) : void
    {
        $profilePictures = new ProfilePictureRepository();
        $profilePictures->remove($oldProfilePictureFilename);
    }

    private function updateUserInfo(string $oldPassword,
                                    string $newPassword,
                                    string &$oldProfilePictureFilename,
                                    string $newProfilePictureFilename,
                                    UserInputErrors $errors) : void
    {
        $customersProfiles = new CustomerProfileRepository();
        $updateErrors = new UserProfileUpdateErrors();

        $customersProfiles->update($oldPassword,
                                   $newPassword,
                                   $oldProfilePictureFilename,
                                   $newProfilePictureFilename,
                                   $updateErrors
        );

        if ($updateErrors->isOldPasswordIncorrect())
        {
            $errMessage = __('validation.current_password');
            $errors->add('old_password', $errMessage);
        }
    }

    /**
     * Updates the user's profile
     */
    public function update(UserProfileViewModel $userProfile,
                           UserInputErrors $errors) : void
    {
        $this->validateInput($userProfile, $errors);

        $newProfilePictureFilename = '';
        $oldProfilePictureFilename = '';
        if (($userProfile->profilePicture !== null) && (! $errors->hasAnyForInput('profile_picture')))
            $this->storeNewProfilePicture($userProfile->profilePicture, $newProfilePictureFilename);

        $this->updateUserInfo($userProfile->oldPassword,
                              $userProfile->newPassword,
                              $oldProfilePictureFilename,
                              $newProfilePictureFilename,
                              $errors
        );

        if (($userProfile->profilePicture !== null) && (! $errors->hasAnyForInput('profile_picture')))
            $this->deleteOldProfilePicture($oldProfilePictureFilename);
    }
}
