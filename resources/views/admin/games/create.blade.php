@extends('layouts.admin')

@section('title', 'Add Game - Admin')

@section('content')
<!-- Hero Section -->
<section class="mb-8 md:mb-12 rounded-2xl overflow-hidden relative group -mx-6 -mt-6 px-6 pt-6">
    <!-- Hero Image Background with Overlay -->
    <div class="relative h-[300px] bg-[#1a1a1a]">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#2a2a2a] to-[#1a1a1a]"></div>
        
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        
        <!-- Content -->
        <div class="relative h-full max-w-7xl mx-auto px-6 md:px-12 flex items-end pb-8">
            <div class="space-y-2 max-w-3xl">
                <h1 class="text-3xl md:text-5xl font-black text-white leading-tight">Add New Game</h1>
                <p class="text-base md:text-lg text-white/90 font-medium">Fill in the details below to add a new game</p>
            </div>
        </div>
        
        <!-- Decorative Element -->
        <div class="absolute top-4 right-4 w-20 h-20 bg-gradient-to-br from-[#FF0080] via-[#FF8C00] to-[#40E0D0] rounded-full opacity-20 blur-3xl"></div>
    </div>
</section>

<div class="max-w-3xl mx-auto px-4 sm:px-6">

    <!-- Form Card -->
    <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-4 sm:p-6 md:p-8 space-y-6 shadow-lg">
        <form method="POST" action="{{ route('admin.games.store') }}" class="space-y-6">
            @csrf

            <!-- Game Name -->
            <div class="space-y-2">
                <label for="nama_game" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Game Name</label>
                <input type="text" name="nama_game" id="nama_game" class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 font-medium text-sm @error('nama_game') border-red-500 @enderror" 
                       placeholder="Enter game name" value="{{ old('nama_game') }}" required>
                @error('nama_game')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Genre -->
            <div class="space-y-2">
                <label for="genre" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Genre</label>
                <select name="genre" id="genre" class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white text-black focus:outline-none focus:ring-2 focus:ring-black/50 font-medium text-sm @error('genre') border-red-500 @enderror" required>
                    <option value="">Select Genre</option>
                    @foreach(\App\Models\Category::all() as $category)
                    <option value="{{ $category->nama }}" {{ old('genre') === $category->nama ? 'selected' : '' }}>
                        {{ $category->nama }}
                    </option>
                    @endforeach
                </select>
                @error('genre')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Platform -->
            <div class="space-y-2">
                <label for="platform" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Platform</label>
                <select name="platform" id="platform" class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white text-black focus:outline-none focus:ring-2 focus:ring-black/50 font-medium text-sm @error('platform') border-red-500 @enderror" required>
                    <option value="">Select Platform</option>
                    @foreach(\App\Models\Platform::all() as $platform)
                    <option value="{{ $platform->nama }}" {{ old('platform') === $platform->nama ? 'selected' : '' }}>
                        {{ $platform->nama }}
                    </option>
                    @endforeach
                </select>
                @error('platform')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price -->
            <div class="space-y-2">
                <label for="harga" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Price (Rp)</label>
                <input type="number" name="harga" id="harga" class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 font-medium text-sm @error('harga') border-red-500 @enderror" 
                       placeholder="0" value="{{ old('harga') }}" required>
                @error('harga')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label for="deskripsi" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Description</label>
                <textarea name="deskripsi" id="deskripsi" class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 font-medium text-sm min-h-[120px] @error('deskripsi') border-red-500 @enderror" 
                          placeholder="Enter game description" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image URL -->
            <div class="space-y-2">
                <label for="gambar" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Image URL</label>
                <input type="text" name="gambar" id="gambar" class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 font-medium text-sm" 
                       placeholder="https://example.com/image.jpg" value="{{ old('gambar') }}">
                @error('gambar')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 pt-6 border-t-2 border-gray-200">
                <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-black text-white font-black rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide text-sm">
                    Save Game
                </button>
                <a href="{{ route('admin.games.index') }}" class="w-full sm:w-auto text-center px-6 py-3 bg-white border-2 border-black text-black font-black rounded-full hover:bg-gray-50 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide text-sm">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection