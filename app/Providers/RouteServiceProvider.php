<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Str;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        parent::boot();
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $identifier = (string) $request->input('identifier', $request->input('email', $request->input('username', '')));
            $key = Str::lower($identifier) . '|' . $request->ip();
            return Limit::perMinute(5)->by($key);
        });

        RateLimiter::for('admin-login', function (Request $request) {
            $identifier = (string) $request->input('identifier', $request->input('email', $request->input('username', '')));
            $key = 'admin|' . Str::lower($identifier) . '|' . $request->ip();
            return Limit::perMinute(5)->by($key);
        });
    }
}
