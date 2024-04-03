<?php

namespace App\Services\Customer;

use App\Errors\UserInputErrors;
use App\ViewModels\Customer\UserProfileViewModel;

/**
 * Subsystem for updating user's profile information.
 */
class UserProfileService
{
    private static function isUserWantsUpdatePassword(UserProfileViewModel $userProfile) : bool
    {
        return $userProfile->newPassword !== '';
    }

    /**
     * Updates the user's profile information.
     */
    public static function update(UserProfileViewModel $userProfile,
                                  UserInputErrors $errors) : void
    {
        if (static::isUserWantsUpdatePassword($userProfile))


        return;
    }
}
