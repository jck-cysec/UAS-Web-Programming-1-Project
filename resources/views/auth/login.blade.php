@extends('layouts.app')

@section('title', 'Login - Nokenz Game Store')

@section('content')
<!-- Hero Section -->
<section class="mb-12 sm:mb-16 md:mb-20 rounded-2xl overflow-hidden relative group">
    <!-- Hero Image Background with Overlay -->
    <div class="relative h-[350px] sm:h-[450px] md:h-[600px] bg-[#1a1a1a]">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#2a2a2a] to-[#1a1a1a]"></div>
        
        <!-- Gradient Overlay untuk readability -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        
        <!-- Content -->
        <div class="relative h-full max-w-7xl mx-auto px-3 sm:px-6 md:px-12 flex items-end pb-6 sm:pb-12 md:pb-20">
            <div class="space-y-3 sm:space-y-6 max-w-3xl">
                <!-- Title -->
                <h1 class="text-3xl sm:text-5xl md:text-7xl lg:text-8xl font-black text-white leading-tight">
                    Welcome Back
                </h1>
                
                <!-- Subtitle -->
                <p class="text-sm sm:text-xl md:text-2xl text-white/90 font-medium max-w-2xl">
                    Sign in to your Nokenz Game Store account
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-2 sm:gap-4 pt-2 sm:pt-4">
                    <a href="#content" 
                       class="inline-flex items-center justify-center px-4 sm:px-8 py-2 sm:py-4 bg-black text-white text-xs sm:text-base sm:text-lg font-bold rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        Sign In
                    </a>
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center justify-center px-4 sm:px-8 py-2 sm:py-4 bg-transparent text-white text-xs sm:text-base sm:text-lg font-bold rounded-full border-2 border-white hover:bg-white hover:text-black transition-all duration-300">
                        Browse Games
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Decorative Element -->
        <div class="absolute top-4 sm:top-8 right-4 sm:right-8 w-20 sm:w-32 h-20 sm:h-32 bg-gradient-to-br from-[#FF0080] via-[#FF8C00] to-[#40E0D0] rounded-full opacity-20 blur-3xl"></div>
    </div>
</section>

<!-- Content Anchor -->
<div id="content"></div>
<div class="min-h-screen flex items-center justify-center px-3 sm:px-4 py-8">
    <div class="w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-black mb-2">Welcome Back</h1>
            <p class="text-xs sm:text-sm text-gray-600">Sign in to your Nokenz Game Store account</p>
        </div>

        <!-- Login Form Card -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-4 sm:p-6 md:p-8 space-y-5 sm:space-y-6 shadow-lg">
            <form method="POST" action="{{ route('login') }}" class="space-y-5 sm:space-y-6">
                @csrf

                <!-- Error Messages -->
                @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-3 sm:p-4 rounded-lg">
                    <p class="text-red-600 font-black text-xs sm:text-sm uppercase tracking-wide">
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </p>
                </div>
                @endif

                <!-- Email or Username -->
                <div class="space-y-2">
                    <label for="identifier" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Email or Username</label>
                    <input
                        type="text"
                        name="identifier"
                        id="identifier"
                        value="{{ old('identifier') }}"
                        class="w-full px-4 py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 transition font-medium @error('identifier') border-red-500 @enderror"
                        placeholder="Enter your email or username"
                        required
                    >
                    @error('identifier')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 transition font-medium text-sm @error('password') border-red-500 @enderror"
                        placeholder="Enter your password"
                        required
                    >
                    @error('password')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Selection -->
                <div class="space-y-2">
                    <label for="role" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Login as</label>
                    <select
                        name="role"
                        id="role"
                        class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white text-black focus:outline-none focus:ring-2 focus:ring-black/50 transition font-medium cursor-pointer text-sm @error('role') border-red-500 @enderror"
                        required
                    >
                        <option value="user">Regular User</option>
                        <option value="admin">Administrator</option>
                    </select>
                    @error('role')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-black hover:bg-black/90 text-white font-black py-3 sm:py-4 px-6 rounded-full transition-all duration-300 transform hover:scale-105 active:scale-95 text-sm sm:text-base uppercase tracking-wide shadow-lg hover:shadow-xl mt-2 sm:mt-4"
                >
                    Sign In
                </button>
            </form>

            <!-- Divider -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t-2 border-black/30"></div>
                </div>
                <div class="relative flex justify-center text-xs sm:text-sm">
                    <span class="px-2 bg-[#E8DCC4] text-gray-700 font-semibold">Or continue with</span>
                </div>
            </div>

            <!-- Social Login Buttons -->
            <div class="flex items-center justify-center gap-4 mt-4">
                <a href="#" class="inline-flex items-center justify-center w-12 h-12 rounded-full border-2 border-black hover:bg-black hover:text-white transition-all duration-300" aria-label="Continue with GitHub" title="Continue with GitHub">
                    <!-- GitHub Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-current text-black" aria-hidden="true"><path d="M12 .5C5.73.5.98 5.25.98 11.52c0 4.66 3.03 8.61 7.24 10.01.53.1.72-.22.72-.49 0-.24-.01-1.04-.02-1.89-2.95.64-3.57-1.42-3.57-1.42-.48-1.21-1.17-1.53-1.17-1.53-.96-.66.07-.64.07-.64 1.06.08 1.62 1.09 1.62 1.09.94 1.61 2.47 1.15 3.07.88.1-.69.37-1.15.67-1.41-2.36-.27-4.84-1.18-4.84-5.24 0-1.16.41-2.11 1.08-2.86-.11-.27-.47-1.37.1-2.86 0 0 .88-.28 2.9 1.08a10.04 10.04 0 012.64-.36c.9 0 1.8.12 2.64.36 2.01-1.36 2.89-1.08 2.89-1.08.57 1.49.21 2.59.1 2.86.67.75 1.07 1.7 1.07 2.86 0 4.07-2.48 4.97-4.84 5.23.38.33.72.98.72 1.98 0 1.42-.01 2.57-.01 2.92 0 .27.19.6.73.5 4.2-1.41 7.22-5.36 7.22-10.01C23.02 5.25 18.27.5 12 .5z"/></svg>
                    <span class="sr-only">Continue with GitHub</span>
                </a>

                <a href="#" class="inline-flex items-center justify-center w-12 h-12 rounded-full border-2 border-black hover:bg-black hover:text-white transition-all duration-300" aria-label="Continue with Google" title="Continue with Google">
                    <!-- Google Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 533.5 544.3" class="w-6 h-6" aria-hidden="true"><path fill="#EA4335" d="M533.5 278.4c0-18.6-1.5-36.5-4.4-53.7H272v101.7h146.9c-6.3 34.1-25.6 62.9-54.6 82.2v68.3h88.3c51.6-47.5 81.9-117.6 81.9-198.5z"/><path fill="#34A853" d="M272 544.3c73.7 0 135.6-24.5 180.9-66.5l-88.3-68.3c-24.6 16.6-56 26.4-92.6 26.4-71 0-131-47.9-152.4-112.3H31.2v70.6C76.4 482.9 167.5 544.3 272 544.3z"/><path fill="#4A90E2" d="M119.6 322.6c-10.9-31.3-10.9-64.5 0-95.8V156.2H31.2C-8.3 216.6-8.3 327.7 31.2 388.1l88.4-65.5z"/><path fill="#FBBC05" d="M272 107.1c39.8 0 75.6 13.7 103.8 40.5l77.8-77.8C405.9 24.4 344 0 272 0 167.5 0 76.4 61.4 31.2 156.2l88.4 70.6C141 154.9 201 107.1 272 107.1z"/></svg>
                    <span class="sr-only">Continue with Google</span>
                </a>

                <a href="#" class="inline-flex items-center justify-center w-12 h-12 rounded-full border-2 border-black hover:bg-black hover:text-white transition-all duration-300" aria-label="Continue with Apple" title="Continue with Apple">
                    <!-- Apple Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-current text-black" aria-hidden="true"><path d="M16.365 1.43c.924 1.096 1.542 2.66 1.363 4.2-1.281.042-2.844-.847-3.764-1.94-.822-.988-1.53-2.552-1.355-4.037 1.44.05 2.951.987 3.756 1.777z"/><path d="M20.8 8.427c-.997.02-2.151.733-2.853.733-.759 0-1.932-.712-3.17-.712-1.523 0-3.307.9-4.309.9C7.274 9.348 4.6 7.95 2 11.14c-3.055 4.032-1.74 11.085 1.192 15.2 1.02 1.28 2.223 2.7 3.88 2.68 1.53-.02 2.052-.92 3.904-.92 1.8 0 2.388.92 3.94.9 1.52-.02 2.47-1.3 3.48-2.58 1.36-1.66 1.924-3.28 2.092-3.63-.047-.02-3.7-1.42-3.75-5.74-.05-5.22 4.2-7.77 4.4-7.9-.98-1.43-2.046-2.1-3.18-2.06z"/></svg>
                    <span class="sr-only">Continue with Apple</span>
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-sm text-gray-700 font-medium">
                Don't have an account?
                <a href="{{ url('register') }}" class="font-black text-black hover:underline transition">
                    Create an account
                </a>
            </p>
        </div>
    </div>
</div>
@endsection