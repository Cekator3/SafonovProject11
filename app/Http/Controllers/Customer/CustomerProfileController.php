<?php

namespace App\Http\Controllers\Customer;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Services\Customer\UserProfileService;
use App\Repositories\ProfilePictureRepository;
use App\ViewModels\Customer\UserProfileViewModel;

class CustomerProfileController extends Controller
{
    private function getProfilePicture(User $user) : string
    {
        $profilePictures = new ProfilePictureRepository();

        // Check if user have profile picture
        if ($user->profile_picture === null)
            return $profilePictures->getDefault();

        // Get profile picture
        $profilePicture = $profilePictures->get($user->profile_picture);
        assert($profilePicture !== '', "User's profile picture not exists but should have been");
        if ($profilePicture === '')
            return $profilePictures->getDefault();

        return $profilePicture;
    }

    /**
     * Displays the user's profile
     */
    public function showCustomerProfile(Request $request) : View
    {
        $user = $request->user();
        assert($user !== null, 'User must be authenticated');

        $profilePicture = $this->getProfilePicture($user);

        return view('customer.user-profile', ['profilePicture' => $profilePicture]);
    }

    private function retrieveUserInput(Request $request) : UserProfileViewModel
    {
        $userProfile = new UserProfileViewModel();

        $userProfile->oldPassword = $request->string('old_password', '');
        $userProfile->newPassword = $request->string('new_password', '');
        $userProfile->newPasswordConfirmation = $request->string('new_password_confirm', '');
        $userProfile->profilePicture = $request->file('profile_picture');

        return $userProfile;
    }

    /**
     * Tries to update customer's profile
     */
    public function updateCustomerProfile(Request $request) : RedirectResponse
    {
        $userProfile = $this->retrieveUserInput($request);
        $errors = new UserInputErrors();

        // Update user's account information
        $userProfiles = new UserProfileService();
        $userProfiles->update($userProfile, $errors);

        if ($errors->hasAny()) {
            return redirect()->back()
                             ->withErrors($errors->getAll())
                             ->withInput();
        }

        return redirect()->back();
    }
}
