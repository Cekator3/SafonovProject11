<?php

namespace App\Repositories\Users;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Errors\Customer\UserProfileUpdateErrors;

/**
 * Subsystem for interaction with stored information on customers profiles
 */
class CustomerProfileRepository extends UserRepository
{
    private function updatePassword(User $user,
                                    string $oldPassword,
                                    string $newPassword,
                                    UserProfileUpdateErrors $errors) : void
    {
        if (! $this->isPasswordMatches($oldPassword, $user->password))
        {
            $errors->setOldPasswordCorrectness(false);
            return;
        }

        $hash = $this->hashPassword($newPassword);
        $user->password = $hash;
    }

    private function updateProfilePicture(User $user,
                                          string $profilePicture) : void
    {
        $user->profile_picture = $profilePicture;
    }

    /**
     * Updates user's profile
     * @param string $oldPassword old user's password
     * @param string $newPassword new user's password
     * @param string $oldProfilePicture old user's profile picture
     * @param string $newProfilePicture new user's profile picture
     * @param UserProfileUpdateErrors $errros errors that were occured during update
     */
    public function update(string $oldPassword,
                           string $newPassword,
                           string &$oldProfilePicture,
                           string $newProfilePicture,
                           UserProfileUpdateErrors $errors) : void
    {
        $user = Auth::user();
        $oldProfilePicture = $user->profile_picture;

        if ($newPassword !== '')
            $this->updatePassword($user, $oldPassword, $newPassword, $errors);
        if ($newProfilePicture !== '')
            $this->updateProfilePicture($user, $newProfilePicture);

        $user->save();
    }
}
