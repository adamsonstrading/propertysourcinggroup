<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OptimizeResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Add performance headers
        if ($response instanceof Response) {
            // Enable HTTP/2 Server Push hints
            $response->headers->set('X-Content-Type-Options', 'nosniff');
            $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
            $response->headers->set('X-XSS-Protection', '1; mode=block');

            // Add timing headers for debugging (remove in production if needed)
            if (config('app.debug')) {
                $response->headers->set('X-Response-Time', round((microtime(true) - LARAVEL_START) * 1000, 2) . 'ms');
            }
        }

        return $response;
    }
}
