<?php

namespace App\ViewModels\Customer;
use Illuminate\Http\UploadedFile;

/**
 * class for transferring input
 * that was entered in user's profile
 * from interfaces (views)
 * to the application (services and repositories).
 */
class UserProfileViewModel
{
    public string $oldPassword;
    public string $newPassword;
    public string $newPasswordConfirmation;
    public UploadedFile|array|null $profilePicture;
}
