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
    private function isAuthenticated(Request $request) : bool
    {
        return $request->user() !== null;
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next) : Response | RedirectResponse
    {
        if (! $this->isAuthenticated($request))
            return $next($request);

        if (! $request->user()->isCustomer())
            return $next($request);

        if (! $request->user()->hasVerifiedEmail())
            return redirect()->route('verification.notice');

        return $next($request);
    }
}
