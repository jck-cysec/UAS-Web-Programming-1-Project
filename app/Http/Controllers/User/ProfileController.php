<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $registrationDate = null;
        if ($user) {
            $createdAt = $user->created_at ?? null;
            if ($createdAt instanceof \DateTimeInterface) {
                $registrationDate = Carbon::instance($createdAt)->format('d F Y');
            } elseif (is_string($createdAt) && !empty($createdAt)) {
                try {
                    $registrationDate = Carbon::parse($createdAt)->format('d F Y');
                } catch (\Exception $e) {
                    $registrationDate = null;
                }
            }
        }

        return view('user.profile.index', compact('user', 'registrationDate'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Check if user is authenticated
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not authenticated.']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;

        // Save user instance
        $user->save(); // Ensure $user is an instance of User

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }

    public function changePasswordForm()
    {
        return view('user.profile.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Check if user is authenticated
        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'User not authenticated.']);
        }

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        $user->fill([
            'password' => Hash::make($request->password),
        ])->save();

        // Logout and regenerate session
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Password changed successfully. Please log in again.');
    }
}