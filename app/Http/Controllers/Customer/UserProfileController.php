<?php

namespace App\Http\Controllers\Customer;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DTOs\Customer\UserProfileDTO;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;

class UserProfileController extends Controller
{
    public function showUserProfile(Request $request) : View
    {
        $user = $request->user();
        assert($user !== null, 'User must be authenticated');

        // Create view data
        $email = $user->email;
        $profilePicture = $user->profile_picture ?? Config::get('users.default_profile_picture');
        $userProfile = new UserProfileDTO($email, $profilePicture);

        return view('customer.user-profile', ['user' => $userProfile]);
    }

    public function updateUserInfo(Request $request) : RedirectResponse
    {
        // ***

        return redirect()->route('user-profile');
    }
}
