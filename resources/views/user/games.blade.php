@extends('layouts.app')

@section('title', 'Games - Nokenz Game Store')

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
                    Browse Games
                </h1>
                
                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-white/90 font-medium max-w-2xl">
                    Discover and play thousands of amazing games
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="#content" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-black text-white text-lg font-bold rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        Search Games
                    </a>
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white text-lg font-bold rounded-full border-2 border-white hover:bg-white hover:text-black transition-all duration-300">
                        Back to Home
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

<!-- Search & Filter Section -->
<div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-6 md:p-8 mb-8 md:mb-12 shadow-lg">
    <form method="GET" action="{{ route('games.index') }}" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="px-4 py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 font-medium" placeholder="Search games...">
            <select name="genre" class="px-4 py-3 border-2 border-black rounded-lg bg-white text-black focus:outline-none focus:ring-2 focus:ring-black/50 font-medium cursor-pointer">
                <option value="">All Genres</option>
                @foreach($categories as $category)
                <option value="{{ $category->nama }}" {{ request('genre') === $category->nama ? 'selected' : '' }}>
                    {{ $category->nama }}
                </option>
                @endforeach
            </select>
            <select name="platform" class="px-4 py-3 border-2 border-black rounded-lg bg-white text-black focus:outline-none focus:ring-2 focus:ring-black/50 font-medium cursor-pointer">
                <option value="">All Platforms</option>
                @foreach($platforms as $platform)
                <option value="{{ $platform->nama }}" {{ request('platform') === $platform->nama ? 'selected' : '' }}>
                    {{ $platform->nama }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="px-8 py-3 bg-black text-white font-black rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg uppercase text-sm tracking-wide">Filter Games</button>
            <a href="{{ route('games.index') }}" class="px-8 py-3 bg-white text-black font-black rounded-full border-2 border-black hover:bg-gray-100 hover:scale-105 transition-all duration-300 shadow-lg uppercase text-sm tracking-wide">Reset</a>
        </div>
    </form>
</div>

<!-- Games Grid -->
<div class="space-y-6">
    @if($games->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($games as $game)
        <div class="group">
            <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black overflow-hidden shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 h-full flex flex-col">
                <!-- Game Image -->
                <div class="aspect-video overflow-hidden bg-gray-200 relative">
                    <img src="{{ $game->gambar }}" alt="{{ $game->nama_game }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>

                <!-- Game Info -->
                <div class="p-6 flex flex-col flex-grow space-y-4">
                    <!-- Title & Dev -->
                    <h3 class="text-lg font-black text-black line-clamp-2">{{ $game->nama_game }}</h3>
                    
                    <!-- Badges -->
                    <div class="flex gap-2 flex-wrap">
                        <span class="inline-block px-3 py-1 bg-black text-white text-xs font-bold uppercase rounded-full">{{ $game->genre }}</span>
                        <span class="inline-block px-3 py-1 bg-black text-white text-xs font-bold uppercase rounded-full">{{ $game->platform }}</span>
                    </div>

                    <!-- Spacer -->
                    <div class="flex-grow"></div>

                    <!-- Price -->
                    <p class="text-2xl font-black text-black">Rp {{ number_format($game->harga) }}</p>

                    <!-- Actions -->
                    <div class="flex gap-2">
                        <a href="{{ route('games.show', $game) }}" class="flex-1 px-4 py-3 bg-black text-white font-bold rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 text-center uppercase text-sm tracking-wide shadow-lg">
                            View
                        </a>
                        @auth
                        <form method="POST" action="{{ route('cart.add', $game) }}" class="flex-1">
                            @csrf
                            <input type="hidden" name="qty" value="1">
                            <button type="submit" class="w-full px-4 py-3 bg-white text-black font-bold rounded-full border-2 border-black hover:bg-gray-100 hover:scale-105 transition-all duration-300 uppercase text-sm tracking-wide shadow-lg">
                                Add Cart
                            </button>
                        </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="flex justify-center py-8">
        {{ $games->links() }}
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-16 space-y-4">
        <p class="text-3xl font-black text-black">No games found</p>
        <p class="text-lg text-gray-700 font-medium">Try adjusting your search filters</p>
        <a href="{{ route('games.index') }}" class="inline-block px-8 py-4 bg-black text-white font-black rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide">
            Clear Filters
        </a>
    </div>
    @endif
</div>
@endsection