<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && Auth::user()?->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    public function showRegister()
    {
        if (Auth::check() && Auth::user()?->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only(['name', 'username', 'email']);
        $data['password'] = Hash::make($request->password);
        $data['role'] = 'user';

        $user = User::create($data);

        Auth::login($user);
        // Prevent session fixation: regenerate session after login
        $request->session()->regenerate();

        return redirect('/');
    }

    public function login(LoginRequest $request)
    {
        $identifier = (string) $request->input('identifier');
        $role = $request->input('role', 'user');
        $key = ( $role === 'admin' ? 'admin|' : '' ) . Str::lower($identifier).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors(['login' => "Too many login attempts. Try again in {$seconds} seconds."]);
        }

        $user = User::where(function ($query) use ($request) {
            $query->where('email', $request->identifier)
                  ->orWhere('username', $request->identifier);
        })->where('role', $role)->first();

        $valid = $user && Hash::check($request->password, $user->password);

        if ($valid) {
            Auth::login($user);
            // Prevent session fixation: regenerate session after login
            $request->session()->regenerate();
            RateLimiter::clear($key);
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect('/');
        }

        RateLimiter::hit($key, 60 * 5);
        // Log failed login attempt for security monitoring (no sensitive info like passwords)
        Log::warning('Failed login attempt', ['identifier' => $identifier, 'ip' => $request->ip(), 'role' => $role]);
        // Generic error message to avoid username enumeration
        return back()->withErrors(['login' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}