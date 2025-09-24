<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

//        $response->headers->set('Content-Security-Policy', "script-src 'https://*.js.stripe.com' 'https://js.stripe.com' 'https://maps.googleapis.com' ;");

        return $response;
    }
}
