@extends('layouts.app')

@section('title', 'Edit Profile - Nokenz Game Store')

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
                    Edit Profile
                </h1>
                
                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-white/90 font-medium max-w-2xl">
                    Update your personal information
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="#content" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-black text-white text-lg font-bold rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        Edit Now
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
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('POST')

            <!-- Name Field -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-black text-black uppercase tracking-wide">Full Name</label>
                <input type="text" name="name" id="name" 
                       class="w-full px-4 py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 font-medium @error('name') border-red-500 @enderror"
                       value="{{ old('name', auth()->user()->name) }}"
                       placeholder="Enter your full name"
                       required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-black text-black uppercase tracking-wide">Email Address</label>
                <input type="email" name="email" id="email" 
                       class="w-full px-4 py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 font-medium @error('email') border-red-500 @enderror"
                       value="{{ old('email', auth()->user()->email) }}"
                       placeholder="Enter your email address"
                       required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Username Field (if exists) -->
            @if(auth()->user()->username)
            <div class="space-y-2">
                <label for="username" class="block text-sm font-black text-black uppercase tracking-wide">Username</label>
                <div class="w-full px-4 py-3 bg-gray-100 flex items-center rounded-lg border-2 border-gray-300 cursor-not-allowed">
                    <span class="text-black font-bold">{{ auth()->user()->username }}</span>
                </div>
                <p class="text-sm text-gray-700 font-medium">Username cannot be changed</p>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex gap-4 pt-6 border-t-2 border-black/20">
                <button type="submit" class="px-8 py-4 bg-black text-white font-black rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide text-lg">
                    Save Changes
                </button>
                <a href="{{ route('profile.index') }}" class="px-8 py-4 bg-white text-black font-black rounded-full border-2 border-black hover:bg-gray-100 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide text-lg">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection