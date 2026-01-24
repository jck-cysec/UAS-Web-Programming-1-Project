@extends('layouts.app')

@section('title', 'Cart - Nokenz Game Store')

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
                    Your Cart
                </h1>
                
                <!-- Subtitle -->
                <p class="text-sm sm:text-xl md:text-2xl text-white/90 font-medium max-w-2xl">
                    Review items before checkout
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-2 sm:gap-4 pt-2 sm:pt-4">
                    <a href="#content" 
                       class="inline-flex items-center justify-center px-4 sm:px-8 py-2 sm:py-4 bg-black text-white text-xs sm:text-base sm:text-lg font-bold rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        Review Cart
                    </a>
                    <a href="{{ route('games.index') }}" 
                       class="inline-flex items-center justify-center px-4 sm:px-8 py-2 sm:py-4 bg-transparent text-white text-xs sm:text-base sm:text-lg font-bold rounded-full border-2 border-white hover:bg-white hover:text-black transition-all duration-300">
                        Continue Shopping
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

<div class="space-y-6 sm:space-y-8">

    @if($carts->isEmpty())
    <!-- Empty State -->
    <div class="bg-[#E8DCC4] rounded-2xl border-4 border-dashed border-black p-8 sm:p-12 md:p-16 text-center space-y-4 shadow-lg">
        <p class="text-2xl sm:text-3xl md:text-4xl font-black text-black">Your cart is empty</p>
        <p class="text-sm sm:text-base md:text-lg text-gray-700 font-medium">Browse our games and add some to your cart</p>
        <a href="{{ route('home') }}" class="inline-block px-6 sm:px-8 py-3 sm:py-4 bg-black text-white font-black rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide text-xs sm:text-sm">
            Continue Shopping
        </a>
    </div>
    @else
    <!-- Cart Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2 space-y-3 sm:space-y-4">
            <div class="bg-white rounded-2xl border-4 border-black overflow-hidden shadow-lg">
                <!-- Header Row - Hidden on Mobile, Visible on SM+ -->
                <div class="hidden sm:grid grid-cols-12 gap-4 bg-black text-white p-3 sm:p-6 font-black text-xs sm:text-sm uppercase tracking-wide">
                    <div class="col-span-5">Game</div>
                    <div class="col-span-2 text-right">Price</div>
                    <div class="col-span-2 text-right">Qty</div>
                    <div class="col-span-2 text-right">Total</div>
                    <div class="col-span-1"></div>
                </div>

                <!-- Cart Items -->
                <div class="divide-y divide-gray-200">
                    @foreach($carts as $cart)
                    <!-- Desktop Version -->
                    <div class="hidden sm:grid grid-cols-12 gap-4 p-3 sm:p-6 items-center hover:bg-gray-50 transition text-xs sm:text-sm">
                        <!-- Game Info -->
                        <div class="col-span-5">
                            <p class="font-black text-black">{{ Str::limit($cart->game->nama_game, 20) }}</p>
                            <p class="text-xs sm:text-sm text-gray-700 font-medium">{{ $cart->game->platform }}</p>
                        </div>

                        <!-- Price -->
                        <div class="col-span-2 text-right">
                            <p class="font-black text-black text-xs sm:text-sm">Rp {{ number_format($cart->game->harga) }}</p>
                        </div>

                        <!-- Quantity -->
                        <div class="col-span-2">
                            <form method="POST" action="{{ route('cart.update', $cart) }}" class="flex items-center justify-end gap-1 sm:gap-2">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="qty" value="{{ $cart->qty }}" min="1" 
                                       class="px-2 sm:px-3 py-2 w-12 sm:w-16 text-center border-2 border-black rounded-lg bg-white text-black font-bold focus:outline-none focus:ring-2 focus:ring-black/50 text-xs sm:text-sm" required>
                                <button type="submit" class="px-3 sm:px-4 py-2 bg-black text-white font-bold rounded-lg hover:bg-black/90 transition-all text-xs uppercase">Upd</button>
                            </form>
                        </div>

                        <!-- Total -->
                        <div class="col-span-2 text-right">
                            <p class="font-black text-black text-xs sm:text-sm">Rp {{ number_format($cart->game->harga * $cart->qty) }}</p>
                        </div>

                        <!-- Remove -->
                        <div class="col-span-1 flex justify-end">
                            <form method="POST" action="{{ route('cart.destroy', $cart) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 font-bold hover:text-red-800 transition text-sm">✕</button>
                            </form>
                        </div>
                    </div>

                    <!-- Mobile Version -->
                    <div class="sm:hidden p-3 space-y-3 border-b last:border-b-0 hover:bg-gray-50 transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-black text-black text-sm">{{ Str::limit($cart->game->nama_game, 20) }}</p>
                                <p class="text-xs text-gray-700 font-medium mt-1">{{ $cart->game->platform }}</p>
                            </div>
                            <form method="POST" action="{{ route('cart.destroy', $cart) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 font-bold hover:text-red-800 transition text-sm">✕</button>
                            </form>
                        </div>
                        
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-700">Price: <span class="font-black text-black">Rp {{ number_format($cart->game->harga) }}</span></span>
                        </div>

                        <div class="flex justify-between items-center gap-2">
                            <form method="POST" action="{{ route('cart.update', $cart) }}" class="flex items-center gap-1 flex-1">
                                @csrf
                                @method('PATCH')
                                <span class="text-xs font-medium text-gray-700">Qty:</span>
                                <input type="number" name="qty" value="{{ $cart->qty }}" min="1" 
                                       class="flex-1 px-2 py-1 text-center border-2 border-black rounded-lg bg-white text-black font-bold focus:outline-none focus:ring-2 focus:ring-black/50 text-xs" required>
                                <button type="submit" class="px-2 py-1 bg-black text-white font-bold rounded-lg hover:bg-black/90 transition-all text-xs">Upd</button>
                            </form>
                        </div>

                        <div class="text-right border-t pt-2">
                            <p class="text-xs text-gray-700">Total: <span class="font-black text-black text-sm">Rp {{ number_format($cart->game->harga * $cart->qty) }}</span></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Continue Shopping -->
            <div class="flex gap-2 sm:gap-4">
                <a href="{{ route('home') }}" class="px-6 sm:px-8 py-3 sm:py-4 bg-white text-black font-black rounded-full border-2 border-black hover:bg-gray-100 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide text-xs sm:text-sm">
                    ← Continue Shopping
                </a>
            </div>
        </div>

        <!-- Cart Summary Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-4 sm:p-6 md:p-8 sticky top-24 space-y-4 sm:space-y-6 shadow-lg">
                <h2 class="text-xl sm:text-2xl font-black text-black uppercase">Order Summary</h2>

                <!-- Summary Details -->
                <div class="space-y-2 sm:space-y-3 pb-4 border-b-2 border-black/20">
                    @php
                        $subtotal = $carts->sum(function($cart) {
                            return $cart->qty * $cart->game->harga;
                        });
                        $tax = $subtotal * 0.1;
                        $total = $subtotal + $tax;
                    @endphp
                    
                    <div class="flex justify-between text-xs sm:text-sm font-medium">
                        <span class="text-gray-700">Subtotal</span>
                        <span class="font-black">Rp {{ number_format($subtotal) }}</span>
                    </div>
                    <div class="flex justify-between text-xs sm:text-sm font-medium">
                        <span class="text-gray-700">Tax (10%)</span>
                        <span class="font-black">Rp {{ number_format($tax) }}</span>
                    </div>
                    <div class="flex justify-between text-xs sm:text-sm font-medium">
                        <span class="text-gray-700">Shipping</span>
                        <span class="font-black text-green-600">Free</span>
                    </div>
                </div>

                <!-- Total -->
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-base sm:text-lg font-black text-black uppercase">Total</span>
                        <span class="text-2xl sm:text-3xl font-black text-black">
                            Rp {{ number_format($total) }}
                        </span>
                    </div>

                    <!-- Checkout Button -->
                    <form method="POST" action="{{ route('checkout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full px-6 py-3 sm:py-4 bg-black text-white font-black rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg block text-center uppercase tracking-wide text-xs sm:text-base">
                            Proceed to Checkout
                        </button>
                    </form>
                </div>

                <!-- Items Count -->
                <div class="pt-3 sm:pt-4 border-t-2 border-black/20 text-center">
                    <p class="text-xs sm:text-sm text-gray-700 font-medium">
                        <span class="font-black text-black">{{ $carts->count() }}</span> item(s) in cart
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection