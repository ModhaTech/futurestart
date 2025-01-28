<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddCspHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->header('Content-Security-Policy', "default-src 'self' *; script-src 'self' 'unsafe-inline' 'unsafe-eval' *; style-src 'self' 'unsafe-inline' *; img-src 'self' data: *; media-src 'self' *; font-src 'self' *; connect-src 'self' *; object-src 'self' *; frame-src 'self' *; child-src 'self' *; form-action 'self' *; frame-ancestors 'self' *; base-uri 'self' *; manifest-src 'self' *; worker-src 'self' *; navigate-to 'self' *;");

        return $response;
    }
}
