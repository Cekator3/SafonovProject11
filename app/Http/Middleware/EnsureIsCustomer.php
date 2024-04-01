<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\HttpResponseStatus;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * A subsystem that generates response with a 404 (Not Found) status code
 * if the authenticated user is not a customer.
 */
class EnsureIsCustomer
{
    private function isCustomer(Request $request) : bool
    {
        $user = $request->user();
        assert($user !== null, 'User must be authenticated');

        return $user->isCustomer();
    }

    /**
     * Handle an incoming request.
     * 
     * @throws HttpException if the user is not a customer
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $this->isCustomer($request))
            abort(HttpResponseStatus::NotFound->value);

        return $next($request);
    }
}
