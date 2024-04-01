<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Shows the home page.
     */
    public function __invoke()
    {
        $user = Auth::user();
        if ($user === null)
            return view('customer.catalog');
        switch ($user->role)
        {
            case UserRole::Customer:
                return view('customer.catalog');
            case UserRole::Admin:
                return view('admin.admin');
        }
    }
}
