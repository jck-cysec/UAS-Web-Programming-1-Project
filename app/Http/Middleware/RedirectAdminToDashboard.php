<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RedirectAdminToDashboard
{
    /**
     * Handle an incoming request.
     *
     * If the authenticated user is an admin and is accessing a non-admin GET page,
     * redirect them to the admin dashboard to ensure they return to the admin area.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Only redirect for safe GET requests to avoid breaking form submissions / APIs
        if (! $request->isMethod('GET')) {
            return $next($request);
        }

        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            $path = ltrim($request->path(), '/');

            // Allow admin routes and asset/ajax requests
            if (Str::startsWith($path, 'admin') || $request->ajax() || $request->wantsJson()) {
                return $next($request);
            }

            // If already on admin dashboard, do nothing
            if ($request->routeIs('admin.dashboard')) {
                return $next($request);
            }

            // Avoid redirecting logout or other auth endpoints
            if ($request->routeIs('logout') || $request->routeIs('admin.logout') || $request->routeIs('login') || $request->routeIs('register')) {
                return $next($request);
            }

            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
