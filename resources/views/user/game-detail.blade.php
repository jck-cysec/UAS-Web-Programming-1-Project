@extends('layouts.app')

@section('title', $game->nama_game . ' - Nokenz Game Store')

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
                    {{ $game->nama_game }}
                </h1>
                
                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-white/90 font-medium max-w-2xl">
                    {{ $game->genre }} for {{ $game->platform }}
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="#content" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-black text-white text-lg font-bold rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        View Details
                    </a>
                    <a href="{{ route('games.index') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white text-lg font-bold rounded-full border-2 border-white hover:bg-white hover:text-black transition-all duration-300">
                        Browse More
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

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="space-y-4">
            <!-- Main Image -->
            <div class="relative bg-gray-200 rounded-2xl overflow-hidden border-4 border-black">
                @if($game->gambar)
                    <img src="{{ $game->gambar }}" alt="{{ $game->nama_game }}" 
                         class="w-full h-auto object-cover aspect-video" id="main-image">
                @else
                    <div class="w-full h-96 flex items-center justify-center bg-gray-300">
                        <span class="text-gray-600 font-bold text-lg">No Image Available</span>
                    </div>
                @endif
            </div>

            <!-- Image Gallery Thumbnails -->
            <div class="flex gap-3 overflow-x-auto pb-2">
                @if($game->gambar)
                <button class="flex-shrink-0 border-4 border-black rounded-lg overflow-hidden hover:opacity-75 transition"
                        onclick="document.getElementById('main-image').src='{{ $game->gambar }}'">
                    <img src="{{ $game->gambar }}" alt="Thumbnail 1" class="w-24 h-24 object-cover">
                </button>
                @endif
                <!-- Placeholder for additional images -->
                @for($i = 1; $i < 4; $i++)
                <div class="flex-shrink-0 border-4 border-dashed border-gray-300 rounded-lg bg-gray-100 w-24 h-24 flex items-center justify-center">
                    <span class="text-gray-400 text-xs font-bold">Image {{ $i + 1 }}</span>
                </div>
                @endfor
            </div>
        </div>

        <!-- Game Description Section -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 space-y-6">
            <div>
                <h2 class="text-3xl md:text-4xl font-black text-black mb-2">{{ $game->nama_game }}</h2>
                <p class="text-base text-gray-700 font-medium">By Unknown Studio</p>
            </div>

            <!-- Genre & Platform -->
            <div class="flex flex-wrap gap-3">
                <span class="inline-block px-4 py-2 bg-black text-white font-bold uppercase text-xs rounded-full">
                    {{ $game->genre }}
                </span>
                <span class="inline-block px-4 py-2 bg-black text-white font-bold uppercase text-xs rounded-full">
                    {{ $game->platform }}
                </span>
            </div>

            <!-- Description -->
            <div class="space-y-3">
                <h3 class="text-xl font-black text-black">About this game</h3>
                <p class="text-base leading-relaxed text-gray-800 font-medium">
                    {{ $game->deskripsi }}
                </p>
            </div>

            <!-- Additional Details -->
            <div class="grid grid-cols-2 gap-4 py-6 border-t-2 border-b-2 border-black/20">
                <div>
                    <p class="text-sm text-gray-700 font-bold uppercase">Genre</p>
                    <p class="text-base font-black text-black">{{ $game->genre }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-700 font-bold uppercase">Platform</p>
                    <p class="text-base font-black text-black">{{ $game->platform }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar (Right) -->
    <aside class="space-y-6">
        <!-- Success Message -->
        @if(session('success'))
        <div class="bg-[#E8DCC4] border-l-4 border-black p-6 rounded-lg text-black font-black text-sm uppercase tracking-wide shadow-lg">
            {{ session('success') }}
        </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg">
            <p class="text-red-600 font-black text-sm uppercase tracking-wide">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </p>
        </div>
        @endif

        <!-- Price Card -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 space-y-6 sticky top-24 shadow-lg">
            <div>
                <p class="text-sm text-gray-700 font-bold uppercase mb-2">Price</p>
                <p class="text-4xl md:text-5xl font-black text-black">
                    Rp {{ number_format($game->harga, 0, ',', '.') }}
                </p>
            </div>

            <!-- CTA Buttons -->
            <div class="space-y-3">
                @auth
                <form method="POST" action="{{ route('cart.add', $game) }}" class="w-full">
                    @csrf
                    <input type="hidden" name="qty" value="1">
                    <button type="submit" class="w-full px-6 py-4 bg-black text-white font-black rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide text-lg">
                        Add to Cart
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="w-full px-6 py-4 bg-black text-white font-black rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide text-lg inline-block text-center">
                    Login to Buy
                </a>
                @endauth

                @auth
                <form method="POST" action="{{ route('wishlist.toggle', $game) }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full px-6 py-4 bg-white text-black font-black rounded-full border-2 border-black hover:bg-gray-100 hover:scale-105 transition-all duration-300 uppercase tracking-wide text-lg shadow-lg">
                        ♡ Add to Wishlist
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="w-full px-6 py-4 bg-white text-black font-black rounded-full border-2 border-black hover:bg-gray-100 hover:scale-105 transition-all duration-300 uppercase tracking-wide text-lg shadow-lg inline-block text-center">
                    Login to Wishlist
                </a>
                @endauth
            </div>

            <!-- Game Info Stats -->
            <div class="border-t-2 border-black/20 pt-6 space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-700 font-bold">Rating</span>
                    <span class="text-lg font-black text-yellow-500">★★★★★</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-700 font-bold">Downloads</span>
                    <span class="text-lg font-black">1.2K</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-700 font-bold">Released</span>
                    <span class="text-lg font-black">2024</span>
                </div>
            </div>
        </div>

        <!-- Share Card -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-6 space-y-4 shadow-lg">
            <h3 class="text-xl font-black text-black uppercase">Share</h3>
            <div class="flex gap-2">
                <button class="flex-1 px-4 py-2 bg-black text-white font-bold rounded-full hover:bg-black/90 transition-all uppercase text-sm">Twitter</button>
                <button class="flex-1 px-4 py-2 bg-black text-white font-bold rounded-full hover:bg-black/90 transition-all uppercase text-sm">Facebook</button>
            </div>
        </div>
    </aside>
</div>

<!-- Back Navigation -->
<div class="mt-12 pt-8 border-t-2 border-black">
    <a href="{{ route('home') }}" class="inline-block px-8 py-4 bg-black text-white font-black rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide">
        ← Back to Games
    </a>
</div>
@endsection