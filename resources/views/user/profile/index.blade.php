@extends('layouts.app')

@section('title', 'My Profile - Nokenz Game Store')

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
                    My Profile
                </h1>
                
                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-white/90 font-medium max-w-2xl">
                    Manage your account settings and personal information
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="#content" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-black text-white text-lg font-bold rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        View Profile
                    </a>
                    <a href="{{ route('profile.edit') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white text-lg font-bold rounded-full border-2 border-white hover:bg-white hover:text-black transition-all duration-300">
                        Edit Profile
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

<!-- Success Message -->
@if(session('success'))
<div class="bg-[#E8DCC4] border-l-4 border-black p-6 rounded-lg text-black font-black text-sm uppercase tracking-wide shadow-lg mb-6">
    {{ session('success') }}
</div>
@endif

<!-- Main Content -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Profile Information -->
    <div class="lg:col-span-2">
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 shadow-lg">
            <h2 class="text-3xl font-black text-black mb-6 uppercase">Profile Information</h2>

            <div class="space-y-6">
                <!-- Name Field -->
                <div class="pb-6 border-b-2 border-black/20">
                    <p class="text-xs text-gray-700 font-bold uppercase mb-1">Full Name</p>
                    <p class="text-xl font-black text-black">{{ auth()->user()->name ?? 'Not set' }}</p>
                </div>

                <!-- Email Field -->
                <div class="pb-6 border-b-2 border-black/20">
                    <p class="text-xs text-gray-700 font-bold uppercase mb-1">Email Address</p>
                    <p class="text-xl font-black text-black">{{ auth()->user()->email ?? 'Not set' }}</p>
                </div>

                <!-- Username Field -->
                <div class="pb-6 border-b-2 border-black/20">
                    <p class="text-xs text-gray-700 font-bold uppercase mb-1">Username</p>
                    <p class="text-xl font-black text-black">{{ auth()->user()->username ?? 'Not set' }}</p>
                </div>

                <!-- Registration Date -->
                <div class="pb-6 border-b-2 border-black/20">
                    <p class="text-xs text-gray-700 font-bold uppercase mb-1">Account Status</p>
                    <span class="inline-block px-4 py-2 bg-green-100 text-green-800 font-black rounded-full text-sm uppercase">Active Member</span>
                </div>

                <!-- Joined Date -->
                <div>
                    <p class="text-xs text-gray-700 font-bold uppercase mb-1">Member Since</p>
                    <p class="text-lg font-black text-black">{{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="lg:col-span-1">
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 shadow-lg sticky top-24 space-y-4">
            <h3 class="text-2xl font-black text-black mb-6 uppercase">Account Actions</h3>
            
            <div class="space-y-3">
                <a href="{{ route('profile.edit') }}" class="block w-full px-6 py-3 bg-black text-white font-black rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 text-center uppercase text-sm shadow-lg">
                    Edit Profile
                </a>
                <a href="{{ route('profile.password') }}" class="block w-full px-6 py-3 bg-white text-black font-black rounded-full border-2 border-black hover:bg-gray-100 hover:scale-105 transition-all duration-300 text-center uppercase text-sm shadow-lg">
                    Change Password
                </a>
                <a href="{{ route('orders.index') }}" class="block w-full px-6 py-3 bg-white text-black font-black rounded-full border-2 border-black hover:bg-gray-100 hover:scale-105 transition-all duration-300 text-center uppercase text-sm shadow-lg">
                    View Orders
                </a>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full px-6 py-3 bg-red-600 text-white font-black rounded-full hover:bg-red-700 hover:scale-105 transition-all duration-300 text-center uppercase text-sm shadow-lg">
                        Logout
                    </button>
                </form>
            </div>

            <!-- Account Info -->
            <div class="pt-6 border-t-2 border-black/20">
                <p class="text-xs text-gray-700 font-bold uppercase">Account Type</p>
                <p class="text-lg font-black text-black">{{ ucfirst(auth()->user()->role ?? 'user') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection