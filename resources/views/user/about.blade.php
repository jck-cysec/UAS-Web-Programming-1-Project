@extends('layouts.app')

@section('title', 'About Us - Nokenz Game Store')

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
                    About Nokenz
                </h1>
                
                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-white/90 font-medium max-w-2xl">
                    Kami adalah platform jual beli game terpercaya yang menghadirkan koleksi terbaik untuk berbagai platform
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="#content" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-black text-white text-sm font-black uppercase tracking-wide rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        Learn More
                    </a>
                    <a href="{{ route('games.index') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white text-sm font-black uppercase tracking-wide rounded-full border-2 border-white hover:bg-white hover:text-black transition-all duration-300">
                        Browse Games
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

<!-- Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Logo Space -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 mb-8 flex items-center justify-center shadow-lg">
            <div class="text-center space-y-4">
                <img src="{{ asset('assets/images/logo-transparent.png') }}" alt="Nokenz Logo" class="h-24 mx-auto">
                <h3 class="text-2xl font-black text-black uppercase tracking-wide">Nokenz Game Store</h3>
            </div>
        </div>

        <!-- Vision & Mission -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 shadow-lg">
            <h2 class="text-2xl md:text-3xl font-black text-black uppercase tracking-wide mb-6">Visi & Misi Kami</h2>
            
            <div class="space-y-6">
                <div class="pb-6 border-b-4 border-black">
                    <h3 class="text-lg font-black text-black uppercase tracking-wide mb-3">Visi</h3>
                    <p class="text-sm text-gray-700 font-medium">
                        Membangun ekosistem digital game terdepan yang dapat diakses oleh seluruh pemain di Indonesia dengan layanan terbaik dan koleksi game paling lengkap.
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-black text-black uppercase tracking-wide mb-4">Misi</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <span class="inline-flex items-center justify-center w-6 h-6 bg-black text-white rounded-full text-xs font-black mt-0.5">✓</span>
                            <span class="text-sm text-gray-700 font-medium">Menyediakan katalog game berkualitas dengan harga kompetitif</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="inline-flex items-center justify-center w-6 h-6 bg-black text-white rounded-full text-xs font-black mt-0.5">✓</span>
                            <span class="text-sm text-gray-700 font-medium">Meningkatkan layanan pelanggan dan keamanan transaksi</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="inline-flex items-center justify-center w-6 h-6 bg-black text-white rounded-full text-xs font-black mt-0.5">✓</span>
                            <span class="text-sm text-gray-700 font-medium">Mendukung developer lokal melalui promosi dan kolaborasi</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- History -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 shadow-lg mt-8">
            <h2 class="text-2xl md:text-3xl font-black text-black uppercase tracking-wide mb-4">Sejarah Singkat</h2>
            <p class="text-sm text-gray-700 font-medium leading-relaxed">
                Nokenz memulai perjalanannya pada tahun 2024 dengan fokus utama sebagai platform pemasaran dan penjualan game-game indie. Berawal dari semangat untuk memajukan karya pengembang independen, kami kini terus berkembang menjadi marketplace yang mengutamakan pengalaman pengguna dan kelengkapan katalog. Kami berkomitmen untuk terus berinovasi guna memberikan layanan terbaik bagi jutaan pemain di seluruh Indonesia.
            </p>
        </div>
    </div>

    <!-- Sidebar - Achievements -->
    <div class="lg:col-span-1">
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 shadow-lg sticky top-24">
            <h3 class="text-xl font-black text-black uppercase tracking-wide mb-6">Pencapaian Kami</h3>
            <div class="space-y-4">
                @forelse($achievements as $ach)
                <div class="text-center p-4 border-2 border-black rounded-lg hover:border-black hover:bg-white/50 transition-all">
                    <p class="text-2xl font-black text-black mb-1">{{ $ach['value'] }}</p>
                    <p class="text-xs text-gray-700 font-medium uppercase tracking-wide">{{ $ach['label'] }}</p>
                </div>
                @empty
                <p class="text-xs text-gray-500 font-medium">No achievements yet</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Why Choose Us -->
<section class="bg-[#1a1a1a] rounded-2xl p-12 md:p-16 mb-12 border-4 border-black shadow-lg">
    <h2 class="text-3xl md:text-4xl font-black text-white uppercase tracking-wide mb-12 text-center">Mengapa Memilih Nokenz?</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 shadow-lg hover:scale-105 transition-all duration-300">
            <div class="text-4xl font-black text-black mb-3">🛡️</div>
            <h3 class="text-lg font-black text-black uppercase tracking-wide mb-2">Aman & Terpercaya</h3>
            <p class="text-sm text-gray-700 font-medium">Transaksi aman dengan berbagai metode pembayaran terenkripsi</p>
        </div>

        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 shadow-lg hover:scale-105 transition-all duration-300">
            <div class="text-4xl font-black text-black mb-3">⚡</div>
            <h3 class="text-lg font-black text-black uppercase tracking-wide mb-2">Pengiriman Cepat</h3>
            <p class="text-sm text-gray-700 font-medium">Kode game dikirim instantly setelah pembayaran dikonfirmasi</p>
        </div>

        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 shadow-lg hover:scale-105 transition-all duration-300">
            <div class="text-4xl font-black text-black mb-3">💰</div>
            <h3 class="text-lg font-black text-black uppercase tracking-wide mb-2">Harga Kompetitif</h3>
            <p class="text-sm text-gray-700 font-medium">Harga terbaik dengan berbagai promosi dan diskon menarik</p>
        </div>
    </div>
</section>

<!-- CTA -->
<div class="text-center py-12">
    <h2 class="text-3xl md:text-4xl font-black text-black uppercase tracking-wide mb-4">Siap Mulai Bermain?</h2>
    <p class="text-sm text-gray-700 font-medium mb-8 max-w-2xl mx-auto">
        Jelajahi ribuan game terbaik di Nokenz Game Store sekarang juga
    </p>
    <div class="flex gap-4 justify-center flex-wrap">
        <a href="{{ route('games.index') }}" class="px-8 py-3 bg-black text-white font-black rounded-full hover:bg-black/90 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide text-sm">
            Lihat Koleksi Games
        </a>
        <a href="{{ route('home') }}" class="px-8 py-3 bg-white border-2 border-black text-black font-black rounded-full hover:bg-gray-50 hover:scale-105 transition-all duration-300 shadow-lg uppercase tracking-wide text-sm">
            Kembali ke Beranda
        </a>
    </div>
</div>

        <!-- Team Section -->
        @if(isset($team) && count($team) > 0)
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-8 shadow-lg mt-12">
            <h3 class="text-2xl font-black text-black uppercase tracking-wide mb-8 text-center">Meet Our Team</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($team as $member)
                <div class="bg-white rounded-2xl border-4 border-black p-6 shadow-lg text-center hover:scale-105 transition-all duration-300">
                    <div class="mb-4">
                        <img
                            src="{{ $member['image'] }}"
                            class="w-20 h-20 rounded-full mx-auto border-2 border-black object-cover"
                            alt="{{ $member['name'] }}"
                        >
                    </div>
                    <h5 class="text-lg font-black text-black uppercase tracking-wide mb-1">{{ $member['name'] }}</h5>
                    <p class="text-sm font-bold text-gray-700 mb-2">{{ $member['role'] }}</p>
                    <p class="text-xs text-gray-600 font-medium">{{ $member['bio'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif
@endsection
