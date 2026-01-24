@extends('layouts.admin')

@section('title', 'Edit News Article - Admin')

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
                <h1 class="text-3xl md:text-5xl font-black text-white leading-tight">Edit News Article</h1>
                <p class="text-base md:text-lg text-white/90 font-medium">Update article details and content</p>
            </div>
        </div>
        
        <!-- Decorative Element -->
        <div class="absolute top-4 right-4 w-20 h-20 bg-gradient-to-br from-[#FF0080] via-[#FF8C00] to-[#40E0D0] rounded-full opacity-20 blur-3xl"></div>
    </div>
</section>

<div class="max-w-3xl mx-auto px-4 sm:px-6">

    <!-- Form Card -->
    <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-4 sm:p-6 md:p-8 shadow-lg space-y-6">
        <form method="POST" action="{{ route('admin.news.update', $news) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title Field -->
            <div class="space-y-2">
                <label for="judul" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Article Title</label>
                <input 
                    type="text" 
                    name="judul" 
                    id="judul" 
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white font-medium focus:ring-2 focus:ring-black/50 text-sm @error('judul') border-red-500 @enderror"
                    value="{{ old('judul', $news->judul) }}"
                    placeholder="Enter article title..."
                    required
                >
                @error('judul')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description Field -->
            <div class="space-y-2">
                <label for="deskripsi" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Description</label>
                <textarea 
                    name="deskripsi" 
                    id="deskripsi" 
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white font-medium focus:ring-2 focus:ring-black/50 text-sm min-h-[200px] @error('deskripsi') border-red-500 @enderror"
                    placeholder="Write your article content here..."
                    required
                >{{ old('deskripsi', $news->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image URL Field -->
            <div class="space-y-2">
                <label for="gambar" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Featured Image URL</label>
                <input 
                    type="url" 
                    name="gambar" 
                    id="gambar" 
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white font-medium focus:ring-2 focus:ring-black/50 text-sm @error('gambar') border-red-500 @enderror"
                    value="{{ old('gambar', $news->gambar) }}"
                    placeholder="https://example.com/image.jpg"
                >
                @error('gambar')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
                
                <!-- Image Preview -->
                @if(old('gambar', $news->gambar))
                <div class="mt-4">
                    <img src="{{ old('gambar', $news->gambar) }}" alt="Preview" class="rounded-lg border-2 border-black max-w-xs h-40 object-cover">
                </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 pt-6 border-t-2 border-black">
                <button type="submit" class="w-full sm:w-auto rounded-full bg-black text-white px-6 py-3 font-black uppercase tracking-wide hover:scale-105 shadow-lg transition-transform text-sm">
                    Update Article
                </button>
                <a href="{{ route('admin.news.index') }}" class="w-full sm:w-auto text-center rounded-full bg-white border-2 border-black text-black px-6 py-3 font-black uppercase tracking-wide hover:scale-105 shadow-lg transition-transform inline-flex items-center justify-center text-sm">
                    Cancel
                </a>
            </div>
            </form>
        </form>
    </div>
</div>
@endsection