@extends('layouts.app')

@section('title', $news->judul . ' - Nokenz Game Store')

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
                    {{ $news->judul }}
                </h1>
                
                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-white/90 font-medium max-w-2xl">
                    📅 {{ \Carbon\Carbon::parse($news->tanggal)->format('d F Y') }}
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="#content" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-black text-white text-lg font-bold rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        Read Article
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

        <!-- Featured Image -->
        @if($news->gambar)
            <div class="w-full overflow-hidden rounded-2xl border-4 border-black shadow-lg">
                <img src="{{ $news->gambar }}" alt="{{ $news->judul }}" 
                     class="w-full h-auto object-cover aspect-video">
            </div>
        @else
            <div class="w-full bg-gradient-to-r from-gray-200 to-gray-300 rounded-2xl border-4 border-black aspect-video flex items-center justify-center shadow-lg">
                <p class="text-3xl font-black text-gray-600">No Image Available</p>
            </div>
        @endif

        <!-- Article Content -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 md:p-10 shadow-lg">
            <div class="prose prose-lg max-w-none">
                <p class="text-base text-gray-800 leading-relaxed whitespace-pre-wrap font-medium">{{ $news->deskripsi }}</p>
            </div>
        </div>

        <!-- Bottom Actions -->
        <div class="flex gap-4 pt-6 border-t-2 border-black">
            <a href="{{ route('home') }}" class="px-8 py-4 bg-white text-black font-black rounded-full border-2 border-black hover:bg-gray-100 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide">
                ← Back to Home
            </a>
        </div>
    </div>

    <!-- Sidebar (1/3 width) -->
    <div class="lg:col-span-1">
        <!-- Article Info Card -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 shadow-lg sticky top-24 space-y-6">
            <div class="space-y-4 pb-6 border-b-2 border-black/20">
                <div>
                    <p class="text-xs text-gray-700 font-bold uppercase mb-1">Published Date</p>
                    <p class="text-lg font-black text-black">{{ \Carbon\Carbon::parse($news->tanggal)->format('d M Y') }}</p>
                </div>
            </div>

            <!-- Navigation -->
            <div class="space-y-2">
                <a href="{{ route('home') }}" class="block w-full px-6 py-3 bg-black text-white font-black rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 text-center uppercase text-sm shadow-lg">
                    Home
                </a>
                <a href="{{ route('games.index') }}" class="block w-full px-6 py-3 bg-white text-black font-black rounded-full border-2 border-black hover:bg-gray-100 hover:scale-105 transition-all duration-300 text-center uppercase text-sm shadow-lg">
                    Browse Games
                </a>
            </div>

            <!-- Share Section -->
            <div class="pt-4 border-t-2 border-black/20">
                <p class="text-sm font-black text-black mb-3 uppercase">Share Article</p>
                <div class="flex gap-2">
                    <button type="button" class="flex-1 px-4 py-2 bg-black text-white font-bold rounded-lg hover:bg-black/90 transition-all text-center" title="Share on Facebook">
                        f
                    </button>
                    <button type="button" class="flex-1 px-4 py-2 bg-black text-white font-bold rounded-lg hover:bg-black/90 transition-all text-center" title="Share on Twitter">
                        𝕏
                    </button>
                    <button type="button" class="flex-1 px-4 py-2 bg-black text-white font-bold rounded-lg hover:bg-black/90 transition-all text-center" title="Copy Link">
                        🔗
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection