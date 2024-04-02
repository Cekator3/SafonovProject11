<?php

namespace App\Http\Controllers\Customer;

use App\Services\Customer\UserProfileService;
use App\ViewModels\Customer\UserProfileViewModel;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;

class UserProfileController extends Controller
{
    /**
     * Displays the user's profile
     */
    public function showUserProfile(Request $request) : View
    {
        $user = $request->user();
        assert($user !== null, 'User must be authenticated');

        // Create view data
        $profilePicture = $user->profile_picture ?? Config::get('users.default_profile_picture');

        return view('customer.user-profile', ['profilePicture' => $profilePicture]);
    }

    private function retrieveUserInput(Request $request) : UserProfileViewModel
    {
        $userProfile = new UserProfileViewModel();

        $userProfile->oldPassword = $request->string('oldPassword', '');
        $userProfile->newPassword = $request->string('newPassword', '');
        $userProfile->newPasswordConfirmation = $request->string('newPasswordConfirmation', '');
        $userProfile->profilePicture = $request->file('profilePicture');

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
        UserProfileService::update($userProfile, $errors);

        if ($errors->hasAny()) {
            return redirect()->back()
                             ->withErrors($errors->getAll())
                             ->withInput();
        }

        return redirect()->back();
    }
}
