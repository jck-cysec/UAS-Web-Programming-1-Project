@extends('layouts.admin')

@section('title', 'Edit Category - Admin')

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
                <h1 class="text-3xl md:text-5xl font-black text-white leading-tight">Edit Category</h1>
                <p class="text-base md:text-lg text-white/90 font-medium">Update the category name and details</p>
            </div>
        </div>
        
        <!-- Decorative Element -->
        <div class="absolute top-4 right-4 w-20 h-20 bg-gradient-to-br from-[#FF0080] via-[#FF8C00] to-[#40E0D0] rounded-full opacity-20 blur-3xl"></div>
    </div>
</section>

<div class="max-w-2xl mx-auto px-4 sm:px-6">

    <!-- Form Card -->
    <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-4 sm:p-6 md:p-8 shadow-lg">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Category Name Field -->
            <div class="space-y-2">
                <label for="nama" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Category Name</label>
                <input 
                    type="text" 
                    name="nama" 
                    id="nama" 
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white font-medium focus:ring-2 focus:ring-black/50 text-sm @error('nama') border-red-500 @enderror"
                    value="{{ old('nama', $category->nama) }}"
                    placeholder="e.g. Action, RPG, Strategy, etc."
                    required
                >
                @error('nama')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 pt-6 border-t-2 border-black">
                <button type="submit" class="w-full sm:w-auto rounded-full bg-black text-white px-6 py-3 font-black uppercase tracking-wide hover:scale-105 shadow-lg transition-transform text-sm">
                    Update Category
                </button>
                <a href="{{ route('admin.categories.index') }}" class="w-full sm:w-auto text-center rounded-full bg-white border-2 border-black text-black px-6 py-3 font-black uppercase tracking-wide hover:scale-105 shadow-lg transition-transform inline-flex items-center justify-center text-sm">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection