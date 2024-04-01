<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * A subsystem that redirects authenticated customers to the
 * email verification page if their email is not verified.
 * 
 * Not authenticated customers are ignored.
 */
class EnsureCustomerCredentialsAreVerified 
{
    private function isUserNeedToVerifyEmail(Request $request) : bool
    {
        $user = $request->user();

        return $user !== null &&
               $user->isCustomer() &&
               (! $user->hasVerifiedEmail());
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next) : Response | RedirectResponse
    {
        if ($this->isUserNeedToVerifyEmail($request))
            return redirect()->route('verification.email.notice');

        return $next($request);
    }
}
