<?php

namespace App\Http\Middleware;

use App\Models\ApiAccess;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiAccessTokenRequired
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, \Closure $next): \Symfony\Component\HttpFoundation\Response
    {
        $access = ApiAccess::where('token', $request->bearerToken() ?? $request->input('access_token'))->first();

        if (! $access) {
            return $request->expectsJson()
                ? new JsonResponse(['error' => 'Unauthenticated.'], 401)
                : new Response('Unauthenticated.', 401);
        }

        // Update a last successful use of the token.
        $access->last_used = Carbon::now()->setTimezone('UTC');
        $access->save();

        return $next($request);
    }
}
