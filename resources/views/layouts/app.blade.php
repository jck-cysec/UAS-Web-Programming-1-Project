<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'NULL Game Store')</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/logo-transparent-white.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo-black.png') }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-900 font-sans">
    <!-- Navigation Bar (Sticky) - Minimalist Design -->
    <nav class="sticky top-0 z-50 bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Brand - Simplified -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 rounded relative flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('assets/images/logo-transparent.png') }}" alt="NOKENZ Logo" class="w-6 h-6 object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                        <div class="hidden absolute inset-0 items-center justify-center text-white font-bold text-sm">N</div>
                    </div>
                    <span class="text-xl font-bold text-black">
                        NOKENZ
                    </span>
                </a>

                <!-- Menu Center (Hidden on mobile) -->
                <div class="hidden md:flex gap-8 items-center">
                    <a href="{{ route('games.index') }}" class="text-sm font-medium text-gray-700 hover:text-black transition-colors">
                        Games
                    </a>
                    <a href="{{ route('about') }}" class="text-sm font-medium text-gray-700 hover:text-black transition-colors">
                        About
                    </a>
                </div>

                <!-- Right Menu -->
                <div class="flex gap-3 items-center">
                    @auth
                        <a href="{{ route('cart.index') }}" class="hidden sm:flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 hover:text-black transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Cart
                        </a>
                        <a href="{{ route('orders.index') }}" class="hidden sm:flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 hover:text-black transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Orders
                        </a>
                        <a href="{{ route('profile.index') }}" class="hidden sm:flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 hover:text-black transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-black text-white text-sm font-medium rounded-full hover:bg-gray-800 transition-colors">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2 bg-black text-white text-sm font-medium rounded-full hover:bg-gray-800 transition-colors">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer - Minimalist Design -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-12">
            <!-- Newsletter Section -->
            <div class="mb-12 pb-12 border-b border-gray-800">
                <div class="max-w-2xl">
                    <h3 class="text-2xl font-bold mb-2">Stay in the Loop</h3>
                    <p class="text-gray-400 mb-6">Get the latest game releases and exclusive offers</p>
                    <form class="flex gap-3 max-w-md">
                        <input type="email" placeholder="Enter your email..." class="flex-1 px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-white transition-colors" required>
                        <button type="submit" class="px-5 py-2.5 bg-white text-black font-medium rounded-lg hover:bg-gray-200 transition-colors">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>

            <!-- Footer Content Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <!-- About -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-white rounded relative flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('assets/images/logo-transparent.png') }}" alt="NOKENZ Logo" class="w-6 h-6 object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                            <div class="hidden absolute inset-0 items-center justify-center text-black font-bold text-sm">N</div>
                        </div>
                        <h4 class="text-xl font-bold">NOKENZ</h4>
                    </div>
                    <p class="text-gray-400 leading-relaxed max-w-md mb-6">A developer-friendly publisher of games for PC, and consoles. Bringing unique gaming experiences to players worldwide.</p>
                    
                    <!-- Social Media -->
                    <div class="flex gap-3">
                        <a href="#" class="w-9 h-9 bg-gray-800 hover:bg-white hover:text-black rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-800 hover:bg-white hover:text-black rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-800 hover:bg-white hover:text-black rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Links 1 -->
                <div>
                    <h5 class="font-bold text-base mb-4">Games</h5>
                    <ul class="space-y-2.5">
                        <li><a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Browse</a></li>
                        <li><a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Categories</a></li>
                        <li><a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Platforms</a></li>
                    </ul>
                </div>

                <!-- Links 2 -->
                <div>
                    <h5 class="font-bold text-base mb-4">Company</h5>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('about') }}" class="text-sm text-gray-400 hover:text-white transition-colors">About</a></li>
                        <li><a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Press Kit</a></li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-800 pt-8 text-center">
                <p class="text-gray-500 text-sm">© 2024 Copyright by 23552011072_HaidirMirzaAhmadZacky_CNSB_UASWEB1</p>
            </div>
        </div>
    </footer>

    @vite('resources/js/app.js')
</body>
</html>