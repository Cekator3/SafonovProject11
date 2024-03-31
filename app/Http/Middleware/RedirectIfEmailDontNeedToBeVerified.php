<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * A subsystem that redirects users to a previous location 
 * if they don't need to confirm their email.
 */
class RedirectIfEmailDontNeedToBeVerified
{
    private function isUserNeedToVerifyEmail(Request $request) : bool
    {
        $user = $request->user();

        // User not authenticated
        if ($user === null)
            return false;

        if (! $user->isCustomer())
            return false;

        return ! $user->hasVerifiedEmail();
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next) : Response | RedirectResponse
    {
        if (! $this->isUserNeedToVerifyEmail($request))
            return redirect()->intended();

        return $next($request);
    }
}
