<?php

namespace App\Services\Customer;

use App\Errors\Customer\UserProfileUpdateErrors;
use App\Errors\UserInputErrors;
use App\Repositories\ProfilePictureRepository;
use App\Repositories\UserRepository;
use App\Services\UserCredentialsValidation\FormatValidation\PasswordFormatValidationService;
use Illuminate\Support\Facades\Auth;
use App\ViewModels\Customer\UserProfileViewModel;

/**
 * Subsystem for updating user's profile information.
 */
class UserProfileService
{
    private function isUserWantsUpdatePassword(UserProfileViewModel $userProfile) : bool
    {
        return $userProfile->newPassword !== '';
    }

    private function isUserWantsUpdateProfilePicture(UserProfileViewModel $userProfile) : bool
    {
        return $userProfile->profilePicture !== null;
    }

    private function validateImageInput(UserProfileViewModel|null $userProfile,
                                        UserInputErrors $errors) : void
    {
        if ($userProfile->profilePicture === null)
            return;
        if(substr($userProfile->profilePicture->getMimeType(), 0, 5) == 'image')
            return;

        $errMessage = __('validation.image');
        $errors->add('profile_picture', $errMessage);
    }

    private function validateInput(UserProfileViewModel $userProfile,
                                   UserInputErrors $errors) : void
    {
        if ($this->isUserWantsUpdatePassword($userProfile))
            PasswordFormatValidationService::validatePassword($userProfile->newPassword, $errors, $userProfile->newPasswordConfirmation, true);

        $this->validateImageInput($userProfile, $errors);
    }

    /**
     * Updates the user's profile
     */
    public function update(UserProfileViewModel $userProfile,
                           UserInputErrors $errors) : void
    {
        $this->validateInput($userProfile, $errors);

        if ($errors->hasAny())
            return;

        $users = new UserRepository();
        $updateErrors = new UserProfileUpdateErrors();
        $users->updateProfile($userProfile, $updateErrors);

        if ($updateErrors->isOldPasswordWrong)
        {
            $errMessage = __('validation.password');
            $errors->add('old_password', $errMessage);
        }

        if ($userProfile->profilePicture !== null)
        {
            $user = Auth::user();
            $profilePictures = new ProfilePictureRepository();
            if ($user->profile_picture === '')
            {
                $profilePictures->add($userProfile->profilePicture, $pfp);
                $user->profile_picture = $pfp;
            }
            else
                $profilePictures->replace($userProfile->profilePicture, $user->profile_picture);
        }
        return;
    }
}
