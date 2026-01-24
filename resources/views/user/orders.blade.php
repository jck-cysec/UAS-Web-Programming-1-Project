@extends('layouts.app')

@section('title', 'Order History - Nokenz Game Store')

@section('content')
<!-- Hero Section -->
<section class="mb-12 sm:mb-16 md:mb-20 rounded-2xl overflow-hidden relative group">
    <!-- Hero Image Background with Overlay -->
    <div class="relative h-[350px] sm:h-[450px] md:h-[600px] bg-[#1a1a1a]">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#2a2a2a] to-[#1a1a1a]"></div>
        
        <!-- Gradient Overlay untuk readability -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        
        <!-- Content -->
        <div class="relative h-full max-w-7xl mx-auto px-3 sm:px-6 md:px-12 flex items-end pb-6 sm:pb-12 md:pb-20">
            <div class="space-y-3 sm:space-y-6 max-w-3xl">
                <!-- Title -->
                <h1 class="text-3xl sm:text-5xl md:text-7xl lg:text-8xl font-black text-white leading-tight">
                    Your Orders
                </h1>
                
                <!-- Subtitle -->
                <p class="text-sm sm:text-xl md:text-2xl text-white/90 font-medium max-w-2xl">
                    Track and manage all your purchases
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-2 sm:gap-4 pt-2 sm:pt-4">
                    <a href="#content" 
                       class="inline-flex items-center justify-center px-4 sm:px-8 py-2 sm:py-4 bg-black text-white text-xs sm:text-base sm:text-lg font-bold rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        View Orders
                    </a>
                    <a href="{{ route('games.index') }}" 
                       class="inline-flex items-center justify-center px-4 sm:px-8 py-2 sm:py-4 bg-transparent text-white text-xs sm:text-base sm:text-lg font-bold rounded-full border-2 border-white hover:bg-white hover:text-black transition-all duration-300">
                        Shop More
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Decorative Element -->
        <div class="absolute top-4 sm:top-8 right-4 sm:right-8 w-20 sm:w-32 h-20 sm:h-32 bg-gradient-to-br from-[#FF0080] via-[#FF8C00] to-[#40E0D0] rounded-full opacity-20 blur-3xl"></div>
    </div>
</section>

<!-- Content Anchor -->
<div id="content"></div>

@if($orders->isEmpty())
<!-- Empty State -->
<div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 sm:p-12 md:p-16 text-center shadow-lg">
    <div class="text-4xl sm:text-5xl md:text-6xl font-black text-gray-600 mb-4">📦</div>
    <p class="text-2xl sm:text-3xl md:text-4xl font-black text-black mb-2">No orders yet</p>
    <p class="text-xs sm:text-sm md:text-base text-gray-700 font-medium mb-6">You haven't made any purchases yet. Start shopping now!</p>
    <a href="{{ route('games.index') }}" class="inline-block px-6 sm:px-8 py-3 sm:py-4 bg-black text-white font-black rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide text-xs sm:text-sm">
        Browse Games
    </a>
</div>
@else
<!-- Orders Table -->
<div class="overflow-x-auto bg-white rounded-2xl border-4 border-black shadow-lg">
    <table class="w-full">
        <thead>
            <tr class="bg-black text-white font-black text-sm uppercase tracking-wide">
                <th class="px-6 py-4 text-left">Order ID</th>
                <th class="px-6 py-4 text-left">Date</th>
                <th class="px-6 py-4 text-left">Items</th>
                <th class="px-6 py-4 text-left">Total Price</th>
                <th class="px-6 py-4 text-left">Status</th>
                <th class="px-6 py-4 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 font-black text-black">#{{ $order->id }}</td>
                <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ \Carbon\Carbon::parse($order->tanggal_order)->format('d M Y') }}</td>
                <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ $order->orderItems->count() }} item(s)</td>
                <td class="px-6 py-4 font-black text-black">Rp {{ number_format($order->total_harga) }}</td>
                <td class="px-6 py-4">
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'paid' => 'bg-green-100 text-green-800',
                            'completed' => 'bg-green-100 text-green-800',
                            'cancelled' => 'bg-red-100 text-red-800'
                        ];
                    @endphp
                    <span class="inline-block px-4 py-2 {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }} font-bold rounded-full text-xs uppercase">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="inline-flex items-center gap-2 justify-center">
                        <a href="{{ route('orders.show', $order) }}" class="px-6 py-2 bg-black text-white font-bold rounded-lg hover:bg-black/90 transition-all text-sm uppercase">
                            View Details
                        </a>

                        <a href="{{ route('orders.export.pdf', $order) }}" class="px-4 py-2 bg-blue-800 text-white font-black rounded-full hover:bg-blue-700 transition-all text-xs uppercase" target="_blank">
                            PDF
                        </a>
                        <a href="{{ route('orders.export.excel', $order) }}" class="px-4 py-2 bg-green-800 text-white font-black rounded-full hover:bg-green-700 transition-all text-xs uppercase">
                            Excel
                        </a>

                        <form method="POST" action="{{ route('orders.destroy', $order) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-black text-white font-black rounded-full hover:bg-black/90 transition-all text-xs uppercase" onclick="return confirm('Are you sure you want to delete this order?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination if needed -->
@if($orders instanceof \Illuminate\Pagination\Paginator || $orders instanceof \Illuminate\Pagination\LengthAwarePaginator)
<div class="flex justify-center mt-8">
    {{ $orders->links() }}
</div>
@endif
@endif
@endsection