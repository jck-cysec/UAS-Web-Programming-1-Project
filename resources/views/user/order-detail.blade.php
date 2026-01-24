@extends('layouts.app')

@section('title', 'Order Detail - Nokenz Game Store')

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
                    Order #{{ $order->id }}
                </h1>
                
                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-white/90 font-medium max-w-2xl">
                    {{ \Carbon\Carbon::parse($order->tanggal_order)->format('d F Y \a\t H:i') }}
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="#content" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-black text-white text-lg font-bold rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        View Details
                    </a>
                    <a href="{{ route('orders.index') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white text-lg font-bold rounded-full border-2 border-white hover:bg-white hover:text-black transition-all duration-300">
                        All Orders
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
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Order Status Card -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 shadow-lg">
            <h2 class="text-3xl font-black text-black mb-6 uppercase">Order Status</h2>
            <div class="flex items-center justify-between">
                <div>
                    @php
                        $statusInfo = [
                            'pending' => ['label' => 'Pending', 'color' => 'bg-yellow-100 text-yellow-800'],
                            'paid' => ['label' => 'Paid', 'color' => 'bg-blue-100 text-blue-800'],
                            'completed' => ['label' => 'Completed', 'color' => 'bg-green-100 text-green-800'],
                            'cancelled' => ['label' => 'Cancelled', 'color' => 'bg-red-100 text-red-800']
                        ];
                        $currentStatus = $statusInfo[$order->status] ?? ['label' => 'Unknown', 'color' => 'bg-gray-100 text-gray-800'];
                    @endphp
                    <span class="inline-block {{ $currentStatus['color'] }} text-base px-4 py-2 font-black rounded-full uppercase">
                        {{ $currentStatus['label'] }}
                    </span>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-700 font-bold">Order Date</p>
                    <p class="text-lg font-black text-black">{{ \Carbon\Carbon::parse($order->tanggal_order)->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 shadow-lg">
            <h2 class="text-3xl font-black text-black mb-6 uppercase">Order Items</h2>
            <div class="space-y-4">
                @foreach($order->orderItems as $item)
                <div class="flex items-center justify-between pb-4 border-b-2 border-black/20 last:border-0 last:pb-0">
                    <div class="flex-grow">
                        <h3 class="text-lg font-black text-black">{{ $item->game->nama_game }}</h3>
                        <p class="text-sm text-gray-700 font-medium">Quantity: {{ $item->qty }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-700 font-bold">Unit Price</p>
                        <p class="text-lg font-black text-black">Rp {{ number_format($item->harga) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
        <!-- Order Summary Card -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 shadow-lg sticky top-24 space-y-6">
            <h3 class="text-2xl font-black text-black uppercase">Order Summary</h3>

            <!-- Calculation -->
            <div class="space-y-3 pb-6 border-b-2 border-black/20">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-700 font-bold">Subtotal:</span>
                    <span class="font-black text-black">Rp {{ number_format($order->orderItems->sum(fn($item) => $item->harga * $item->qty)) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-700 font-bold">Tax (10%):</span>
                    <span class="font-black text-black">Rp {{ number_format($order->orderItems->sum(fn($item) => $item->harga * $item->qty) * 0.1) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-700 font-bold">Shipping:</span>
                    <span class="font-black text-green-600">Free</span>
                </div>
            </div>

            <!-- Total -->
            <div class="flex justify-between items-center">
                <span class="text-lg font-black text-black uppercase">Total:</span>
                <span class="text-3xl font-black text-black">Rp {{ number_format($order->total_harga) }}</span>
            </div>

            <!-- Items Count -->
            <div class="pt-4 border-t-2 border-black/20">
                <p class="text-sm text-gray-700 font-bold">Total Items</p>
                <p class="text-2xl font-black text-black">{{ $order->orderItems->sum('qty') }} Item(s)</p>
            </div>

            <!-- Actions -->
            <div class="flex gap-2 pt-4 border-t-2 border-black/20">
                <a href="{{ route('orders.index') }}" class="flex-1 px-4 py-3 bg-black text-white font-black rounded-lg hover:bg-black/90 transition-all text-center text-sm uppercase shadow-lg">
                    Back
                </a>
                <a href="{{ route('orders.export.pdf', $order) }}" class="px-4 py-3 bg-blue-800 text-white font-black rounded-lg hover:bg-blue-700 transition-all text-center text-sm uppercase shadow-lg" target="_blank">
                    Export PDF
                </a>
                <a href="{{ route('orders.export.excel', $order) }}" class="px-4 py-3 bg-green-800 text-white font-black rounded-lg hover:bg-green-700 transition-all text-center text-sm uppercase shadow-lg">
                    Export Excel
                </a>
            </div>
        </div>
    </div>
</div>
@endsection