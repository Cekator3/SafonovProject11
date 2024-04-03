<?php

namespace App\Repositories\Users;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Errors\Customer\UserProfileUpdateErrors;
use App\ViewModels\Customer\UserProfileViewModel;

class CustomerProfileRepository extends UserRepository
{
    private function updatePassword(Authenticatable $user,
                                    string $oldPassword,
                                    string $newPassword,
                                    UserProfileUpdateErrors $errors) : void
    {
        // ...
    }

    private function updateProfilePicture(Authenticatable $user,
                                          string $profilePicture,
                                          UserProfileUpdateErrors $errors) : void
    {
        // ...
    }

    /**
     * Updates user's profile
     */
    public function update(string $oldPassword,
                           string $newPassword,
                           string $profilePicture,
                           UserProfileUpdateErrors $errors) : void
    {
        $user = Auth::user();
        if ($newPassword !== '')
            $this->updatePassword($user, $oldPassword, $newPassword, $errors);
        if ($profilePicture !== '')
            $this->updateProfilePicture($user, $profilePicture, $errors);
    }
}
