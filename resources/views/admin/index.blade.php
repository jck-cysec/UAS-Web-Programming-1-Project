@extends('layouts.admin')

@section('title', 'Games Management')

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
                <h1 class="text-4xl md:text-6xl font-black text-white leading-tight">Games Management</h1>
                <p class="text-lg md:text-xl text-white/90 font-medium">Manage all games in your store</p>
            </div>
        </div>
        
        <!-- Decorative Element -->
        <div class="absolute top-8 right-8 w-24 h-24 bg-gradient-to-br from-[#FF0080] via-[#FF8C00] to-[#40E0D0] rounded-full opacity-20 blur-3xl"></div>
    </div>
</section>

<div class="space-y-6">
    <!-- Action Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <a
            href="/admin/games/create"
            class="inline-flex items-center justify-center bg-black hover:bg-black/90 text-white font-black py-3 px-6 rounded-full transition transform hover:scale-105 active:scale-95 shadow-lg uppercase tracking-wide text-sm"
        >
            + Add New Game
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-[#E8DCC4] border-l-4 border-black p-6 rounded-lg text-black font-black text-sm uppercase tracking-wide shadow-lg">
        {{ session('success') }}
    </div>
    @endif

    <!-- Games Table -->
    <div class="bg-white rounded-2xl border-4 border-black overflow-hidden shadow-lg">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-black text-white border-b-2 border-gray-200">
                        <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wide">#</th>
                        <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wide">Game Name</th>
                        <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wide">Genre</th>
                        <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wide">Platform</th>
                        <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wide">Price</th>
                        <th class="px-6 py-4 text-center text-xs font-black uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($games as $game)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm font-black text-black">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-black">{{ $game->nama_game }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-blue-100 text-black uppercase tracking-wide">{{ $game->genre }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-orange-100 text-black uppercase tracking-wide">{{ $game->platform }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-black">Rp {{ number_format($game->harga) }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a
                                    href="/admin/games/{{ $game->id }}/edit"
                                    class="inline-flex items-center justify-center bg-black hover:bg-black/90 text-white font-black py-2 px-4 rounded-full transition transform hover:scale-105 shadow-lg text-xs uppercase tracking-wide"
                                >
                                    ✎ Edit
                                </a>
                                <form action="/admin/games/{{ $game->id }}/delete" method="POST" class="inline">
                                    @csrf
                                    <button
                                        type="submit"
                                        onclick="return confirm('Are you sure you want to delete this game?')"
                                        class="inline-flex items-center justify-center bg-black hover:bg-black/90 text-white font-black py-2 px-4 rounded-full transition transform hover:scale-105 shadow-lg text-xs uppercase tracking-wide"
                                    >
                                        🗑 Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center">
                            <p class="text-sm text-gray-500 font-medium">No games found. <a href="/admin/games/create" class="text-black font-black hover:underline">Create one</a></p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
