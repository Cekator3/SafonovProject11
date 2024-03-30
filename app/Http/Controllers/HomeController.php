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
            return view('Customer.customer');
        switch ($user->role)
        {
            case UserRole::Customer:
                return view('Customer.customer');
            case UserRole::Admin:
                return view('Admin.admin');
        }
    }
}
