@extends('layouts.admin')

@section('title', 'Manage Reviews - Admin')

@section('content')
<!-- Hero Section -->
<section class="mb-16 md:mb-20 rounded-2xl overflow-hidden relative group -mx-6 -mt-6 px-6 pt-6">
    <!-- Hero Image Background with Overlay -->
    <div class="relative h-[350px] md:h-[400px] bg-[#1a1a1a]">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#2a2a2a] to-[#1a1a1a]"></div>
        
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        
        <!-- Content -->
        <div class="relative h-full max-w-7xl mx-auto px-6 md:px-12 flex items-end pb-12">
            <div class="space-y-4 max-w-3xl">
                <h1 class="text-4xl md:text-6xl font-black text-white leading-tight">Reviews Management</h1>
                <p class="text-lg md:text-xl text-white/90 font-medium">Manage game reviews and ratings from users</p>
            </div>
        </div>
        
        <!-- Decorative Element -->
        <div class="absolute top-8 right-8 w-24 h-24 bg-gradient-to-br from-[#FF0080] via-[#FF8C00] to-[#40E0D0] rounded-full opacity-20 blur-3xl"></div>
    </div>
</section>

<div class="space-y-6">
    <!-- Reviews Table -->
    <div class="bg-white rounded-2xl border-4 border-black overflow-hidden shadow-lg">
        <div class="overflow-x-auto">
            <table class="w-full text-xs sm:text-sm">
                <thead>
                    <tr class="bg-black text-white border-b-2 border-gray-200">
                        <th class="px-2 sm:px-6 py-2 sm:py-4 text-left text-xs font-black uppercase tracking-wide">#</th>
                        <th class="px-2 sm:px-6 py-2 sm:py-4 text-left text-xs font-black uppercase tracking-wide">Reviewer</th>
                        <th class="hidden sm:table-cell px-2 sm:px-6 py-2 sm:py-4 text-left text-xs font-black uppercase tracking-wide">Game</th>
                        <th class="px-2 sm:px-6 py-2 sm:py-4 text-left text-xs font-black uppercase tracking-wide">Rating</th>
                        <th class="hidden md:table-cell px-2 sm:px-6 py-2 sm:py-4 text-left text-xs font-black uppercase tracking-wide">Comment</th>
                        <th class="px-2 sm:px-6 py-2 sm:py-4 text-left text-xs font-black uppercase tracking-wide">Status</th>
                        <th class="px-2 sm:px-6 py-2 sm:py-4 text-center text-xs font-black uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($reviews as $review)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-2 sm:px-6 py-2 sm:py-4 text-xs sm:text-sm font-black text-black">{{ $loop->iteration }}</td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 text-xs sm:text-sm font-bold text-black">{{ Str::limit($review->user->nama ?? 'Unknown', 12) }}</td>
                        <td class="hidden sm:table-cell px-2 sm:px-6 py-2 sm:py-4 text-xs sm:text-sm font-bold text-black">{{ Str::limit($review->game->nama_game ?? 'N/A', 12) }}</td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 text-xs sm:text-sm font-bold text-black">⭐ {{ $review->rating ?? 'N/A' }}/5</td>
                        <td class="hidden md:table-cell px-2 sm:px-6 py-2 sm:py-4 text-xs sm:text-sm font-medium text-gray-700 max-w-xs">
                            <div class="truncate" title="{{ $review->review_text ?? '' }}">{{ \Illuminate\Support\Str::limit($review->review_text ?? '', 25) }}</div>
                        </td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 text-xs">
                            <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-black bg-black text-white uppercase tracking-wide">
                                {{ Str::limit(ucfirst($review->status ?? 'pending'), 8) }}
                            </span>
                        </td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4">
                            <div class="flex flex-col sm:flex-row items-center justify-center gap-1 sm:gap-2">
                                @if($review->status == 'pending')
                                <form method="POST" action="{{ route('admin.reviews.approve', $review) }}" class="inline w-full sm:w-auto">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="w-full inline-flex items-center justify-center bg-black hover:bg-black/90 text-white font-black py-1 sm:py-2 px-3 sm:px-4 rounded-full transition transform hover:scale-105 shadow-lg text-xs uppercase tracking-wide">
                                        ✓ <span class="hidden sm:inline">Approve</span>
                                    </button>
                                </form>
                                @endif
                                <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center bg-black hover:bg-black/90 text-white font-black py-2 px-4 rounded-full transition transform hover:scale-105 shadow-lg text-xs uppercase tracking-wide" onclick="return confirm('Are you sure you want to delete this review?')">
                                        🗑 Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center">
                            <p class="text-sm text-gray-500 font-medium">No reviews found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection