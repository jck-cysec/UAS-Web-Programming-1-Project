@extends('layouts.app')

@section('title', 'Change Password - Nokenz Game Store')

@section('content')
<!-- Hero Section -->
<section class="mb-16 md:mb-20 rounded-2xl overflow-hidden relative group">
    <!-- Hero Image Background with Overlay -->
    <div class="relative h-[500px] md:h-[600px] bg-[#1a1a1a]">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#2a2a2a] to-[#1a1a1a]"></div>
        
        <!-- Gradient Overlay untuk readability -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        
        <!-- Content -->
        <div class="relative h-full max-w-7xl mx-auto px-6 md:px-12 flex items-end pb-12 md:pb-20">
            <div class="space-y-6 max-w-3xl">
                <!-- Title -->
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-white leading-tight">
                    Change Password
                </h1>
                
                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-white/90 font-medium max-w-2xl">
                    Update your account password to keep your account secure
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="#content" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-black text-white text-lg font-bold rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        Update Password
                    </a>
                    <a href="{{ route('profile.index') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white text-lg font-bold rounded-full border-2 border-white hover:bg-white hover:text-black transition-all duration-300">
                        Back to Profile
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Decorative Element -->
        <div class="absolute top-8 right-8 w-32 h-32 bg-gradient-to-br from-[#FF0080] via-[#FF8C00] to-[#40E0D0] rounded-full opacity-20 blur-3xl"></div>
    </div>
</section>

<!-- Content Anchor -->
<div id="content"></div>

<!-- Error Messages -->
@if($errors->any())
<div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg mb-6">
    <p class="text-red-600 font-black text-sm uppercase tracking-wide">
        @foreach($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </p>
</div>
@endif

<!-- Form -->
<div class="max-w-2xl">
    <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 shadow-lg">
        <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-6">
            @csrf

            <!-- Current Password -->
            <div class="space-y-2">
                <label for="current_password" class="block text-sm font-black text-black uppercase tracking-wide">Current Password</label>
                <input type="password" name="current_password" id="current_password" 
                       class="w-full px-4 py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 font-medium @error('current_password') border-red-500 @enderror"
                       placeholder="Enter your current password"
                       required>
                @error('current_password')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Divider -->
            <div class="py-4 border-t-2 border-black/20"></div>

            <!-- New Password -->
            <div class="space-y-2">
                <label for="password" class="block text-sm font-black text-black uppercase tracking-wide">New Password</label>
                <input type="password" name="password" id="password" 
                       class="w-full px-4 py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 font-medium @error('password') border-red-500 @enderror"
                       placeholder="Enter a strong new password"
                       required>
                @error('password')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-700 font-medium">Must be at least 8 characters long</p>
            </div>

            <!-- Confirm Password -->
            <div class="space-y-2">
                <label for="password_confirmation" class="block text-sm font-black text-black uppercase tracking-wide">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       class="w-full px-4 py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 font-medium @error('password_confirmation') border-red-500 @enderror"
                       placeholder="Re-enter your new password"
                       required>
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Security Tips -->
            <div class="bg-black/10 border-2 border-black/30 rounded-2xl p-6 mt-6">
                <p class="text-lg font-black text-black mb-3">💡 Password Tips</p>
                <ul class="text-sm text-gray-800 space-y-2 font-medium">
                    <li>• Use at least 8 characters</li>
                    <li>• Mix uppercase and lowercase letters</li>
                    <li>• Include numbers and special characters</li>
                    <li>• Avoid using personal information</li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 pt-6 border-t-2 border-black/20">
                <button type="submit" class="px-8 py-4 bg-black text-white font-black rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide text-lg">
                    Update Password
                </button>
                <a href="{{ route('profile.index') }}" class="px-8 py-4 bg-white text-black font-black rounded-full border-2 border-black hover:bg-gray-100 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide text-lg">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection