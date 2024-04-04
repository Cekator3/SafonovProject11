<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController
{
    /**
     * Shows the home page.
     */
    public function __invoke(Request $request) : View
    {
        $user = $request->user();

        // If not authenticated
        if ($user === null)
            return view('customer.catalog');

        switch ($user->role)
        {
            case UserRole::Customer:
                return view('customer.catalog');
            case UserRole::Admin:
                return view('admin.admin');
        }

        // Fallback
        assert(false, 'User role in home controller is unknown.');
        return view('customer.catalog');
    }
}
