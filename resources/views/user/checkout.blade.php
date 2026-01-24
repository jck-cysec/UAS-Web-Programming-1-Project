@extends('layouts.app')

@section('title', 'Checkout - Nokenz Game Store')

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
                    Checkout
                </h1>
                
                <!-- Subtitle -->
                <p class="text-sm sm:text-xl md:text-2xl text-white/90 font-medium max-w-2xl">
                    Review and confirm your order
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-2 sm:gap-4 pt-2 sm:pt-4">
                    <a href="#content" 
                       class="inline-flex items-center justify-center px-4 sm:px-8 py-2 sm:py-4 bg-black text-white text-xs sm:text-base sm:text-lg font-bold rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        Complete Order
                    </a>
                    <a href="{{ route('cart.index') }}" 
                       class="inline-flex items-center justify-center px-4 sm:px-8 py-2 sm:py-4 bg-transparent text-white text-xs sm:text-base sm:text-lg font-bold rounded-full border-2 border-white hover:bg-white hover:text-black transition-all duration-300">
                        Back to Cart
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

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 max-w-5xl mx-auto px-3 sm:px-6">

        <!-- Billing Information -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-4 sm:p-6 md:p-8 space-y-4 sm:space-y-6 shadow-lg">
            <h2 class="text-xl sm:text-2xl md:text-3xl font-black text-black uppercase">Billing Information</h2>

            <form method="POST" action="{{ route('checkout') }}" class="space-y-4 sm:space-y-6" id="checkout-form">
                @csrf

                <!-- Error Messages -->
                @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-3 sm:p-4 rounded-lg">
                    <p class="text-red-600 font-black text-xs sm:text-sm uppercase tracking-wide">
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </p>
                </div>
                @endif

                <!-- Customer Name -->
                <div class="space-y-2">
                    <label for="nama" class="block text-xs sm:text-sm font-black text-black uppercase tracking-wide">Full Name</label>
                    <input type="text" id="nama" name="nama" class="w-full px-3 sm:px-4 py-2 sm:py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 font-medium text-sm @error('nama') border-red-500 @enderror" 
                           value="{{ old('nama', Auth::user()->nama) }}" required>
                    @error('nama')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-black text-black uppercase tracking-wide">Email Address</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 font-medium @error('email') border-red-500 @enderror" 
                           value="{{ old('email', Auth::user()->email) }}" required>
                    @error('email')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                </div>

                <!-- Address -->
                <div class="space-y-2">
                    <label for="alamat" class="block text-sm font-black text-black uppercase tracking-wide">Address</label>
                    <textarea id="alamat" name="alamat" class="w-full px-4 py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 font-medium min-h-[100px] @error('alamat') border-red-500 @enderror" 
                              placeholder="Enter your shipping address" required></textarea>
                    @error('alamat')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                </div>

                <!-- City & Postal Code -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="kota" class="block text-sm font-black text-black uppercase tracking-wide">City</label>
                        <input type="text" id="kota" name="kota" class="w-full px-4 py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 font-medium @error('kota') border-red-500 @enderror" 
                               placeholder="Your city" required>
                        @error('kota')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                    </div>
                    <div class="space-y-2">
                        <label for="kode_pos" class="block text-sm font-black text-black uppercase tracking-wide">Postal Code</label>
                        <input type="text" id="kode_pos" name="kode_pos" class="w-full px-4 py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 font-medium @error('kode_pos') border-red-500 @enderror" 
                               placeholder="12345" required>
                        @error('kode_pos')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="space-y-2">
                    <label for="no_telp" class="block text-sm font-black text-black uppercase tracking-wide">Phone Number</label>
                    <input type="tel" id="no_telp" name="no_telp" class="w-full px-4 py-3 border-2 border-black rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-black/50 font-medium @error('no_telp') border-red-500 @enderror" 
                           placeholder="+62 812 3456 7890" required>
                    @error('no_telp')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                </div>

                <!-- Payment Method -->
                <div class="space-y-4 pt-4 border-t-2 border-black/20">
                    <h3 class="text-xl font-black text-black uppercase">Payment Method</h3>
                    
                    <div class="space-y-3">
                        <label class="flex items-center p-4 border-2 border-black rounded-lg cursor-pointer hover:bg-black hover:text-white transition-all">
                            <input type="radio" name="payment_method" value="transfer_bank" class="w-4 h-4" checked>
                            <span class="ml-3 flex-1 font-black uppercase text-sm">Bank Transfer</span>
                        </label>

                        <label class="flex items-center p-4 border-2 border-black rounded-lg cursor-pointer hover:bg-black hover:text-white transition-all">
                            <input type="radio" name="payment_method" value="e_wallet" class="w-4 h-4">
                            <span class="ml-3 flex-1 font-black uppercase text-sm">E-Wallet (OVO, DANA, etc)</span>
                        </label>

                        <label class="flex items-center p-4 border-2 border-black rounded-lg cursor-pointer hover:bg-black hover:text-white transition-all">
                            <input type="radio" name="payment_method" value="credit_card" class="w-4 h-4">
                            <span class="ml-3 flex-1 font-black uppercase text-sm">Credit Card</span>
                        </label>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="flex items-start gap-3 p-4 bg-black/10 rounded-lg border-2 border-black/30">
                    <input type="checkbox" id="terms" name="terms" class="w-4 h-4 mt-1 border-2 border-black" required>
                    <label for="terms" class="text-sm text-gray-800 font-medium">
                        I agree to the <a href="#" class="font-black underline hover:text-black">terms and conditions</a> 
                        and <a href="#" class="font-black underline hover:text-black">privacy policy</a>
                    </label>
                </div>
            </form>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4">
            <button type="submit" form="checkout-form" class="flex-1 px-6 py-4 bg-black text-white font-black rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide text-lg">
                Confirm Order
            </button>
            <a href="{{ route('cart.index') }}" class="flex-1 px-6 py-4 bg-white text-black font-black rounded-full border-2 border-black hover:bg-gray-100 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide text-lg inline-flex items-center justify-center">
                Back to Cart
            </a>
        </div>
    </div>

    <!-- Order Summary (Right) -->
    <aside class="sticky top-24 h-fit">
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 space-y-6 shadow-lg">
            <h2 class="text-2xl font-black text-black uppercase">Order Summary</h2>

            <!-- Items List -->
            <div class="space-y-4 max-h-64 overflow-y-auto">
                @php $total = 0; @endphp
                @forelse(session('cart', []) as $item)
                    @php $total += $item['harga'] * $item['quantity']; @endphp
                    <div class="flex justify-between items-start pb-4 border-b-2 border-black/20">
                        <div>
                            <p class="font-black text-black line-clamp-2">{{ $item['nama_game'] }}</p>
                            <p class="text-sm text-gray-700 font-medium mt-1">Qty: {{ $item['quantity'] }}</p>
                        </div>
                        <p class="font-black text-black text-right">Rp {{ number_format($item['harga'] * $item['quantity']) }}</p>
                    </div>
                @empty
                    <p class="text-gray-600 text-center py-8 font-medium">No items in cart</p>
                @endforelse
            </div>

            <!-- Summary Details -->
            <div class="space-y-3 py-4 border-t-2 border-b-2 border-black/20">
                <div class="flex justify-between text-base font-medium">
                    <span class="text-gray-700">Subtotal</span>
                    <span class="font-black">Rp {{ number_format($total) }}</span>
                </div>
                <div class="flex justify-between text-base font-medium">
                    <span class="text-gray-700">Shipping</span>
                    <span class="font-black text-green-600">Free</span>
                </div>
                <div class="flex justify-between text-base font-medium">
                    <span class="text-gray-700">Tax</span>
                    <span class="font-black">Rp {{ number_format($total * 0.1) }}</span>
                </div>
            </div>

            <!-- Total -->
            <div class="space-y-4">
                <div class="flex justify-between items-center pt-4">
                    <span class="text-lg font-black text-black uppercase">Total</span>
                    <span class="text-3xl font-black text-black">
                        Rp {{ number_format($total * 1.1) }}
                    </span>
                </div>

                <!-- Security Badge -->
                <div class="flex items-center gap-2 p-3 bg-black/10 rounded-lg border-2 border-black/30">
                    <span class="text-xl">🔒</span>
                    <span class="text-sm text-gray-800 font-bold">Secure checkout powered by NULL</span>
                </div>
            </div>
        </div>

        <!-- Customer Support Card -->
        <div class="mt-6 bg-white rounded-lg border-2 border-black p-6 text-center space-y-3">
            <h3 class="text-h6 font-bold">Need Help?</h3>
            <p class="text-body-sm text-gray-600">Contact our support team</p>
            <a href="mailto:support@null.com" class="inline-block btn btn-secondary btn-sm">
                support@null.com
            </a>
        </div>
    </aside>
</div>
@endsection