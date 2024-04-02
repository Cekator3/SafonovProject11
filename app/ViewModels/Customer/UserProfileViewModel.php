<?php

namespace App\ViewModels\Customer;
use Illuminate\Http\UploadedFile;

/**
 * Class for transferring input
 * that was entered in user's profile
 * from interfaces (views)
 * to the application (Services and Repositories).
 */
class UserProfileViewModel
{
    public string $oldPassword;
    public string $newPassword;
    public string $newPasswordConfirmation;
    public UploadedFile|array|null $profilePicture;
}
