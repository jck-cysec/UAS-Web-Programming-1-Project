<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CspReportOnly
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only add CSP in report-only mode when enabled in env
        if (env('CSP_REPORT_ONLY', false)) {
            // Report-only policy to collect violations without breaking the site
            $policy = "default-src 'self'; img-src 'self' data: https:; script-src 'self' https: 'unsafe-inline'; style-src 'self' 'unsafe-inline'; report-uri /csp-report";
            $response->headers->set('Content-Security-Policy-Report-Only', $policy);
        }

        return $response;
    }
}
