@extends('layouts.app')

@section('title', 'Register - Nokenz Game Store')

@section('content')
<!-- Hero Section -->
<section class="mb-12 sm:mb-16 md:mb-20 rounded-2xl overflow-hidden relative group">
    <div class="relative h-[350px] sm:h-[450px] md:h-[600px] bg-[#1a1a1a]">
        <div class="absolute inset-0 bg-gradient-to-br from-[#2a2a2a] to-[#1a1a1a]"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        <div class="relative h-full max-w-7xl mx-auto px-3 sm:px-6 md:px-12 flex items-end pb-6 sm:pb-12 md:pb-20">
            <div class="space-y-3 sm:space-y-6 max-w-3xl">
                <h1 class="text-3xl sm:text-5xl md:text-7xl lg:text-8xl font-black text-white leading-tight">Create an Account</h1>
                <p class="text-sm sm:text-xl md:text-2xl text-white/90 font-medium max-w-2xl">Join Nokenz and start exploring games</p>
                <div class="flex flex-wrap gap-2 sm:gap-4 pt-2 sm:pt-4">
                    <a href="#content" class="inline-flex items-center justify-center px-4 sm:px-8 py-2 sm:py-4 bg-black text-white text-xs sm:text-base sm:text-lg font-bold rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">Get Started</a>
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-4 sm:px-8 py-2 sm:py-4 bg-transparent text-white text-xs sm:text-base sm:text-lg font-bold rounded-full border-2 border-white hover:bg-white hover:text-black transition-all duration-300">Browse Games</a>
                </div>
            </div>
        </div>
        <div class="absolute top-4 sm:top-8 right-4 sm:right-8 w-20 sm:w-32 h-20 sm:h-32 bg-gradient-to-br from-[#FF0080] via-[#FF8C00] to-[#40E0D0] rounded-full opacity-20 blur-3xl"></div>
    </div>
</section>

<div id="content"></div>
<div class="min-h-screen flex items-center justify-center px-3 sm:px-4 py-8">
    <div class="w-full max-w-md">
        <div class="text-center mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-black mb-2">Create an Account</h1>
            <p class="text-xs sm:text-sm text-gray-600">Fill the form below to register a new account</p>
        </div>

        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-4 sm:p-6 md:p-8 space-y-4 sm:space-y-6 shadow-lg">
            <form method="POST" action="{{ route('register.post') }}" class="space-y-4 sm:space-y-6">
                @csrf

                @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-3 sm:p-4 rounded-lg">
                    <p class="text-red-600 font-black text-xs sm:text-sm uppercase tracking-wide">
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </p>
                </div>
                @endif

                <div class="space-y-2">
                    <label for="name" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 transition font-medium text-sm @error('name') border-red-500 @enderror" placeholder="Your full name" required>
                    @error('name')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-2">
                    <label for="username" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 transition font-medium text-sm @error('username') border-red-500 @enderror" placeholder="Choose a username" required>
                    @error('username')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-2">
                    <label for="email" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 transition font-medium text-sm @error('email') border-red-500 @enderror" placeholder="you@example.com" required>
                    @error('email')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 transition font-medium text-sm @error('password') border-red-500 @enderror" placeholder="Create a password" required>
                    @error('password')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 transition font-medium text-sm" placeholder="Confirm your password" required>
                </div>

                @if(config('services.recaptcha.site_key'))
                <div class="space-y-2">
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                    @error('recaptcha')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                    @error('g-recaptcha-response')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                </div>
                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                @endif

                <button type="submit" class="w-full bg-black hover:bg-black/90 text-white font-black py-3 sm:py-4 px-6 rounded-full transition-all duration-300 transform hover:scale-105 active:scale-95 text-sm sm:text-base uppercase tracking-wide shadow-lg hover:shadow-xl mt-2 sm:mt-4">Create Account</button>
            </form>

            <div class="text-center mt-3 sm:mt-4">
                <p class="text-xs sm:text-sm text-gray-700 font-medium">Already have an account? <a href="{{ route('login') }}" class="font-black text-black hover:underline transition">Sign In</a></p>
            </div>
        </div>
    </div>
</div>
@endsection