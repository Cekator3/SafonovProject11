<?php

namespace App\Repositories;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Str;
use App\DTOs\Auth\UserAuthDTO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Errors\UserCredentialsUniquenessErrors;
use App\Errors\Customer\UserProfileUpdateErrors;
use App\ViewModels\Customer\UserProfileViewModel;
use App\ViewModels\Auth\CustomerRegistrationViewModel;
use Illuminate\Database\UniqueConstraintViolationException;

/**
 * Subsystem for interacting with information about users
 */
class UserRepository
{
    public function updateProfile(UserProfileViewModel $userProfile,
                                  UserProfileUpdateErrors $errors) : void
    {
        $user = Auth::user();
        if ($userProfile->newPassword !== '')
        {
            $errors->isOldPasswordWrong = Hash::check($userProfile->oldPassword, $user->password);
            if (! $errors->isOldPasswordWrong)
                $user->password = $userProfile->newPassword;
        }

        if ($userProfile->profilePicture !== '')
        {
            $user->profile_picture = $userProfile->profilePicture;
        }

        $user->save();
    }
}
