<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ensure login rate limiter exists (fallback if RouteServiceProvider not loaded)
        RateLimiter::for('login', function (Request $request) {
            $identifier = (string) $request->input('identifier', $request->input('email', $request->input('username', '')));
            $key = Str::lower($identifier) . '|' . $request->ip();
            return Limit::perMinute(5)->by($key);
        });

        // Register rate limiter (throttle registrations per IP)
        RateLimiter::for('register', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        // Production sanity checks (non-invasive): log warnings if basic cryptographic or debug settings are insecure
        if (app()->environment('production')) {
            if (empty(config('app.key'))) {
                logger()->warning('APP_KEY is missing in production environment. This weakens encryption and session security.');
            }
            if (config('app.debug')) {
                logger()->warning('APP_DEBUG is true in production. Set APP_DEBUG=false to avoid leaking sensitive information.');
            }
        }
    }
}
