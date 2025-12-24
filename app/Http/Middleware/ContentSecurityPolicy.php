<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only apply CSP to HTML responses
        if ($response->headers->get('Content-Type') && 
            str_contains($response->headers->get('Content-Type'), 'text/html')) {
            
            // Generate nonce for inline scripts if needed
            $nonce = base64_encode(random_bytes(16));
            
            // Load CSP configuration
            $cspConfig = config('csp.csp', []);
            
            // Build CSP header
            $csp = [];
            foreach ($cspConfig as $directive => $sources) {
                if (is_array($sources)) {
                    $csp[] = $directive . ' ' . implode(' ', $sources);
                } else {
                    $csp[] = $directive . ' ' . $sources;
                }
            }
            
            // Fallback CSP if config is not available
            if (empty($csp)) {
                $csp = [
                    "default-src 'self' http: https: data: blob: 'unsafe-inline' 'unsafe-eval'",
                    "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://fonts.googleapis.com https://cdn.jsdelivr.net https://cdnjs.cloudflare.com http: https: data: blob:",
                    "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
                    "font-src 'self' https://fonts.gstatic.com",
                    "img-src 'self' data: https: blob:",
                    "connect-src 'self'",
                    "frame-src 'none'",
                    "object-src 'none'",
                    "base-uri 'self'",
                    "form-action 'self'"
                ];
            }

            // Set CSP header
            $response->headers->set('Content-Security-Policy', implode('; ', $csp));
            
            // Also set nonce for potential future use
            $response->headers->set('X-Nonce', $nonce);
        }

        return $response;
    }
}
