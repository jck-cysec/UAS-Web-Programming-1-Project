@extends('layouts.app')

@section('title', 'Homepage - Nokenz Game Store')

@section('content')
<!-- Hero Section -->
<section class="mb-16 md:mb-20 rounded-2xl overflow-hidden relative group">
    <!-- Hero Image Background with Overlay -->
    <div class="relative h-[500px] md:h-[600px] bg-[#1a1a1a]">
        <!-- Background Image (ganti dengan game featured image jika ada) -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#2a2a2a] to-[#1a1a1a]">
            <!-- Optional: Jika ada featured game image -->
            {{-- <img src="{{ asset('images/hero-bg.jpg') }}" alt="Featured Game" class="w-full h-full object-cover opacity-40"> --}}
        </div>
        
        <!-- Gradient Overlay untuk readability -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        
        <!-- Content -->
        <div class="relative h-full max-w-7xl mx-auto px-6 md:px-12 flex items-end pb-12 md:pb-20">
            <div class="space-y-6 max-w-3xl">
                <!-- Title -->
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-white leading-tight">
                    Welcome to NOKENZ
                </h1>
                
                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-white/90 font-medium max-w-2xl">
                    Discover the best games for PC, and consoles
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="#games" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-white text-black text-lg font-bold rounded-full hover:bg-white/90 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        Browse Games
                    </a>
                    <a href="{{ route('about') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white text-lg font-bold rounded-full border-2 border-white hover:bg-white hover:text-black transition-all duration-300">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Decorative Element (Subtle) -->
        <div class="absolute top-8 right-8 w-32 h-32 bg-white rounded-full opacity-10 blur-3xl"></div>
    </div>
</section>


<!-- Filter and Search Section -->
<section class="mb-12" id="games">
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-4xl md:text-5xl font-black text-black">What game are you looking for?</h2>
            </div>
        </div>
    </div>
</section>

<!-- Games Carousel (transform-based) -->
<section class="mb-16">
    @if($games->isEmpty())
    <div class="col-span-full text-center py-16">
        <div class="inline-flex flex-col items-center space-y-4">
            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
            </div>
            <p class="text-2xl font-bold text-gray-600">No games found</p>
            <p class="text-gray-500">Try adjusting your filters or search terms</p>
        </div>
    </div>
    @else
    <div class="relative carousel-container overflow-hidden px-12" aria-roledescription="carousel" aria-label="Featured games carousel">
        <!-- Inner track -->
        <div class="carousel-track flex transition-transform duration-300 ease-in-out" style="transform: translateX(0);">
            @foreach($games->take(5) as $game)
            <div class="carousel-card flex-shrink-0 w-full md:w-1/2 lg:w-1/3 px-3" role="group" aria-label="Game {{ $loop->iteration }} of 5">
                <div class="group relative">
                    <div class="relative bg-[#E8DCC4] rounded-2xl overflow-hidden border-4 border-black hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                        <div class="relative bg-gray-200 overflow-hidden aspect-video">
                            @if($game->gambar)
                                <img src="{{ $game->gambar }}" alt="{{ $game->nama_game }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-300">
                                    <span class="text-gray-600 font-bold text-lg">No Image</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300"></div>
                        </div>

                        <div class="p-6 space-y-4">
                            <div>
                                <h3 class="text-2xl font-black text-black line-clamp-2 group-hover:text-black/70 transition-colors">{{ $game->nama_game }}</h3>
                                <p class="text-sm text-gray-600 mt-2 font-medium">By Unknown Studio</p>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <span class="inline-flex items-center px-4 py-2 rounded-full bg-black text-white text-xs font-bold uppercase tracking-wide">{{ $game->genre }}</span>
                                <span class="inline-flex items-center px-4 py-2 rounded-full bg-white border-2 border-black text-black text-xs font-bold uppercase tracking-wide">{{ $game->platform }}</span>
                            </div>

                            <div class="pt-4 border-t-2 border-black/20">
                                <p class="text-3xl font-black text-black">Rp {{ number_format($game->harga) }}</p>
                            </div>

                            <div class="flex gap-3 pt-2">
                                <a href="{{ route('games.show', $game) }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-black text-white text-sm font-bold rounded-full hover:bg-black/80 hover:scale-105 transition-all duration-300 text-center shadow-lg">View Details</a>
                                @auth
                                <form method="POST" action="{{ route('cart.add', $game) }}" class="flex-1" onsubmit="this.querySelector('button').disabled=true;">
                                    @csrf
                                    <input type="hidden" name="qty" value="1">
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-transparent text-black text-sm font-bold rounded-full border-2 border-black hover:bg-black hover:text-white transition-all duration-300 shadow-lg">Add to Cart</button>
                                </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Controls -->
        <button id="carousel-prev" type="button" aria-label="Previous slide" class="carousel-control left-4 top-1/2 -translate-y-1/2 absolute z-20 w-10 h-10 rounded-full bg-black text-white flex items-center justify-center hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-accent-blue/30" tabindex="0">&#8249;</button>
        <button id="carousel-next" type="button" aria-label="Next slide" class="carousel-control right-4 top-1/2 -translate-y-1/2 absolute z-20 w-10 h-10 rounded-full bg-black text-white flex items-center justify-center hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-accent-blue/30" tabindex="0">&#8250;</button>
    </div>
    @endif
</section>

<script>
    (function () {
        const container = document.querySelector('.carousel-container');
        if (!container) return;

        const track = container.querySelector('.carousel-track');
        const cards = Array.from(track.querySelectorAll('.carousel-card'));
        const total = cards.length; // should be 5

        // Controls
        const prevBtn = container.querySelector('#carousel-prev');
        const nextBtn = container.querySelector('#carousel-next');

        // State
        let currentSlide = 0;
        let visible = calcVisible();
        let cardWidth = calcCardWidth();
        let maxSlide = Math.max(0, total - visible);

        // Initialize
        update();

        // Resize handling
        window.addEventListener('resize', () => {
            visible = calcVisible();
            cardWidth = calcCardWidth();
            maxSlide = Math.max(0, total - visible);
            if (currentSlide > maxSlide) currentSlide = maxSlide;
            update();
        });

        // Button handlers
        prevBtn.addEventListener('click', () => { if (currentSlide > 0) { currentSlide--; update(); resetAutoplay(); } });
        nextBtn.addEventListener('click', () => { if (currentSlide < maxSlide) { currentSlide++; update(); resetAutoplay(); } });

        // Keyboard navigation
        container.setAttribute('tabindex', '0');
        container.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') { prevBtn.click(); }
            if (e.key === 'ArrowRight') { nextBtn.click(); }
        });

        // Touch / swipe support
        let touchStartX = null;
        track.addEventListener('touchstart', (e) => { touchStartX = e.touches[0].clientX; stopAutoplay(); }, { passive: true });
        track.addEventListener('touchend', (e) => {
            if (touchStartX === null) return;
            const dx = e.changedTouches[0].clientX - touchStartX;
            if (dx > 50) { if (currentSlide > 0) currentSlide--; }
            else if (dx < -50) { if (currentSlide < maxSlide) currentSlide++; }
            update();
            touchStartX = null;
            setTimeout(startAutoplay, 500);
        }, { passive: true });

        // Prevent buttons overlapping content by keeping padding in container
        // Accessibility: focus styles are provided via Tailwind classes on buttons

        // Autoplay (looping)
        let autoplayTimer = null;
        function startAutoplay() {
            if (total <= visible) return;
            stopAutoplay();
            autoplayTimer = setInterval(() => {
                if (currentSlide < maxSlide) currentSlide++;
                else currentSlide = 0;
                update();
            }, 3500);
        }
        function stopAutoplay() { if (autoplayTimer) { clearInterval(autoplayTimer); autoplayTimer = null; } }
        function resetAutoplay() { stopAutoplay(); startAutoplay(); }

        // Pause on hover / pointer interaction
        container.addEventListener('mouseenter', stopAutoplay);
        container.addEventListener('mouseleave', startAutoplay);
        container.addEventListener('pointerdown', stopAutoplay);
        container.addEventListener('pointerup', () => setTimeout(startAutoplay, 500));

        // Helpers
        function calcVisible() {
            const w = window.innerWidth;
            if (w >= 1024) return 3; // desktop
            if (w >= 768) return 2;  // tablet
            return 1; // mobile
        }
        function calcCardWidth() {
            if (!cards[0]) return 0;
            return cards[0].getBoundingClientRect().width;
        }

        function update() {
            const translateX = -(currentSlide * cardWidth);
            track.style.transform = `translateX(${translateX}px)`;

            // Update buttons disabled state
            const atStart = currentSlide <= 0;
            const atEnd = currentSlide >= maxSlide;

            updateButton(prevBtn, !atStart);
            updateButton(nextBtn, !atEnd);
        }

        function updateButton(btn, enabled) {
            if (enabled) {
                btn.removeAttribute('disabled');
                btn.classList.remove('opacity-50','cursor-not-allowed');
                btn.setAttribute('aria-disabled', 'false');
            } else {
                btn.setAttribute('disabled', '');
                btn.classList.add('opacity-50','cursor-not-allowed');
                btn.setAttribute('aria-disabled', 'true');
            }
        }

        // Start autoplay if needed
        startAutoplay();
    })();
</script>

<!-- Latest News Section -->
<section class="mt-20 mb-16">
    <div class="mb-10">
        <h2 class="text-4xl md:text-5xl font-black text-black">Latest News</h2>
        <p class="text-lg text-gray-600 mt-3">Stay updated with our latest announcements and releases</p>
    </div>

    <!-- News Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @forelse($news as $item)
        <div class="group relative">
            <!-- Card dengan Border Hitam (TANPA PELANGI) -->
            <div class="relative bg-[#E8DCC4] rounded-2xl overflow-hidden border-4 border-black hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <!-- Image Container -->
                <div class="relative bg-gray-200 overflow-hidden aspect-video">
                    @if($item->gambar)
                        <img src="{{ $item->gambar }}" 
                             alt="{{ $item->judul }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-300">
                            <span class="text-gray-600 font-bold text-lg">No Image</span>
                        </div>
                    @endif
                    
                    <!-- Date Badge -->
                    <div class="absolute top-4 left-4 bg-black text-white px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide">
                        {{ $item->tanggal?->format('M d, Y') ?? 'No date' }}
                    </div>
                </div>

                <!-- News Content -->
                <div class="p-6 space-y-4">
                    <div>
                        <h3 class="text-2xl font-black text-black line-clamp-2 group-hover:text-black/70 transition-colors">
                            {{ $item->judul }}
                        </h3>
                    </div>

                    <p class="text-base text-gray-700 line-clamp-3 leading-relaxed">
                        {{ Str::limit($item->deskripsi, 120) }}
                    </p>

                    <div class="pt-2">
                        <a href="{{ route('news.show', $item) }}" 
                           class="inline-flex items-center justify-center px-8 py-3 bg-black text-white text-sm font-bold rounded-full hover:bg-black/80 hover:scale-105 transition-all duration-300 shadow-lg">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16">
            <div class="inline-flex flex-col items-center space-y-4">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-gray-600">No news available</p>
                <p class="text-gray-500">Check back later for updates</p>
            </div>
        </div>
        @endforelse
    </div>
</section>
@endsection