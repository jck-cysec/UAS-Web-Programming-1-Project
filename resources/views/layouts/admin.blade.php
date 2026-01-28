<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Nokenz Game Store')</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/logo-transparent-white.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo-transparent.png') }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-900 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="hidden md:flex md:w-64 bg-black text-white flex-col border-r-4 border-black sticky top-0 max-h-screen overflow-y-auto">
            <div class="p-6 border-b-2 border-gray-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-white rounded relative flex items-center justify-center">
                        <img src="{{ asset('assets/images/logo-transparent.png') }}" alt="Logo" class="w-6 h-6 object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                        <div class="hidden absolute inset-0 items-center justify-center text-black font-bold text-sm">N</div>
                    </div>
                    <span class="text-lg font-black text-white">NOKENZ</span>
                </a>
            </div>
            
            <nav class="flex-1 px-4 py-8 space-y-2">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest px-4 mb-4">Management</p>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-bold uppercase tracking-wide transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-white text-black' : 'text-white hover:bg-gray-800' }}">
                    <i class="fas fa-chart-line"></i>
                    Dashboard
                </a>
                
                <a href="{{ route('admin.games.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-bold uppercase tracking-wide transition-all {{ request()->routeIs('admin.games.*') ? 'bg-white text-black' : 'text-white hover:bg-gray-800' }}">
                    <i class="fas fa-gamepad"></i>
                    Games
                </a>
                
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-bold uppercase tracking-wide transition-all {{ request()->routeIs('admin.categories.*') ? 'bg-white text-black' : 'text-white hover:bg-gray-800' }}">
                    <i class="fas fa-list"></i>
                    Categories
                </a>
                
                <a href="{{ route('admin.news.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-bold uppercase tracking-wide transition-all {{ request()->routeIs('admin.news.*') ? 'bg-white text-black' : 'text-white hover:bg-gray-800' }}">
                    <i class="fas fa-newspaper"></i>
                    News
                </a>
                
                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-bold uppercase tracking-wide transition-all {{ request()->routeIs('admin.orders.*') ? 'bg-white text-black' : 'text-white hover:bg-gray-800' }}">
                    <i class="fas fa-shopping-cart"></i>
                    Orders
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-bold uppercase tracking-wide transition-all {{ request()->routeIs('admin.users.*') ? 'bg-white text-black' : 'text-white hover:bg-gray-800' }}">
                    <i class="fas fa-users"></i>
                    Users
                </a>
            </nav>

            <div class="p-6 border-t-2 border-gray-800">
                <form method="POST" action="{{ route('admin.logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full px-4 py-3 bg-white text-black font-bold rounded-full hover:bg-gray-200 transition-all duration-300 shadow-lg text-sm uppercase tracking-wide">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <header class="sticky top-0 z-40 bg-white border-b-2 border-gray-200 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 md:px-8 py-4 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-black text-black">Admin Panel</h1>
                        <p class="text-sm text-gray-600 mt-1">Welcome back, {{ Auth::user()->name ?? 'Admin' }}</p>
                    </div>
                    
                    <!-- Mobile Menu Button -->
                    <button type="button" class="md:hidden px-4 py-2 bg-black text-white font-bold rounded-full hover:bg-gray-800 transition-all">≡</button>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-auto bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 md:px-8 py-8">
                    @yield('content')
                </div>

                <!-- Footer - Minimalist -->
                <footer class="bg-gray-900 text-white mt-16">
                    <div class="max-w-7xl mx-auto px-4 md:px-8 py-8">
                        <!-- Logo -->
                        <div class="flex justify-center mb-6">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-white rounded relative flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset('assets/images/logo-transparent.png') }}" alt="NOKENZ Logo" class="w-6 h-6 object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                                    <div class="hidden absolute inset-0 items-center justify-center text-black font-bold text-sm">N</div>
                                </div>
                                <h4 class="text-xl font-bold">NOKENZ</h4>
                            </div>
                        </div>

                        <!-- Copyright -->
                        <div class="border-t border-gray-800 pt-6 text-center">
                            <p class="text-gray-500 text-sm">© 2024 Copyright by 23552011072_HaidirMirzaAhmadZacky_CNSB_UASWEB1</p>
                        </div>
                    </div>
                </footer>
            </main>
        </div>
    </div>

    @vite('resources/js/app.js')
</body>
</html>