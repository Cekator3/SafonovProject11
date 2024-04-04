<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\HttpResponseStatus;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * A subsystem that generates response with a 404 (Not Found) status code
 * if the authenticated user is not an admin.
 */
class EnsureIsAdmin
{
    private function isAdmin(Request $request) : bool
    {
        $user = $request->user();
        assert($user !== null, 'User must be authenticated');

        return $user->isAdmin();
    }

    /**
     * Handle an incoming request.
     *
     * @throws HttpException if the user is not a admin
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $this->isAdmin($request))
            abort(HttpResponseStatus::NotFound->value);

        return $next($request);
    }
}
