<?php

namespace App\Http\Middleware;

use App\Models\ApiAccess;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ApiAccessTokenRequired
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, \Closure $next): \Symfony\Component\HttpFoundation\Response
    {
        $bearToken = $request->bearerToken() ?? $request->input('access_token');
        $originDomain = parse_url($request->header('Origin'));
        $originDomainString = $originDomain['port'] ? $originDomain['host'] . ':' . $originDomain['port'] : $originDomain['host'];
        $accessRow = ApiAccess::where('domain_name',$originDomainString)->first() ?? ApiAccess::where('domain_name', '*')->first();
        $access = $accessRow && Hash::check($bearToken, $accessRow->token);
        if (!$access) {
            return $request->expectsJson()
                ? new JsonResponse(['error' => 'Unauthenticated.'], 401)
                : new Response('Unauthenticated.', 401);
        }

        // Update a last successful use of the token.
        $accessRow->last_used = Carbon::now()->setTimezone('UTC');
        $accessRow->save();

        return $next($request);
    }
}
