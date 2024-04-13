<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController
{
    /**
     * Shows the home page.
     */
    public function __invoke(Request $request) : RedirectResponse
    {
        $user = $request->user();

        // If not authenticated
        if ($user === null)
            return redirect()->route('catalog');

        switch ($user->role)
        {
            case UserRole::Customer:
                return redirect()->route('catalog');
            case UserRole::Admin:
                return redirect()->route('catalog');
        }

        // Fallback
        assert(false, 'User role in home controller is unknown.');
        return redirect()->route('catalog');
    }
}
