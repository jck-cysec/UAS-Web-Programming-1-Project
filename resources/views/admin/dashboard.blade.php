@extends('layouts.admin')

@section('page-title', 'Dashboard')

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
        <div class="relative h-full max-w-7xl mx-auto px-6 md:px-12 flex items-end pb-12 rounded-2xl">
            <div class="space-y-4 max-w-3xl">
            <h1 class="text-4xl md:text-6xl font-black text-white leading-tight">Dashboard</h1>
            <p class="text-lg md:text-xl text-white/90 font-medium">Welcome back! Here's your store overview</p>
            </div>
        </div>
        
        <!-- Decorative Element -->
        <div class="absolute top-8 right-8 w-24 h-24 bg-gradient-to-br from-[#FF0080] via-[#FF8C00] to-[#40E0D0] rounded-full opacity-20 blur-3xl"></div>
    </div>
</section>

<div class="space-y-8">

    <!-- Stats Grid Row 1 -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Games Card -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-6 space-y-3 shadow-lg">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-black text-black uppercase tracking-wide">Total Games</h3>
                <span class="text-2xl">🎮</span>
            </div>
            <p class="text-3xl font-black text-black">{{ $totalGames }}</p>
            <p class="text-xs text-gray-700 font-medium">Games available</p>
        </div>

        <!-- Total Users Card -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-6 space-y-3 shadow-lg">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-black text-black uppercase tracking-wide">Total Users</h3>
                <span class="text-2xl">👥</span>
            </div>
            <p class="text-3xl font-black text-black">{{ $totalUsers }}</p>
            <p class="text-xs text-gray-700 font-medium">Registered users</p>
        </div>

        <!-- Total Orders Card -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-6 space-y-3 shadow-lg">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-black text-black uppercase tracking-wide">Total Orders</h3>
                <span class="text-2xl">📦</span>
            </div>
            <p class="text-3xl font-black text-black">{{ $totalOrders }}</p>
            <p class="text-xs text-gray-700 font-medium">All orders</p>
        </div>

        <!-- Pending Orders Card -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-6 space-y-3 shadow-lg">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-black text-black uppercase tracking-wide">Pending</h3>
                <span class="text-2xl">⏳</span>
            </div>
            <p class="text-3xl font-black text-black">{{ $pendingOrders }}</p>
            <p class="text-xs text-gray-700 font-medium">Awaiting payment</p>
        </div>
    </div>

    <!-- Stats Grid Row 2 -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Total Reviews Card -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-6 space-y-3 shadow-lg">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-black text-black uppercase tracking-wide">Total Reviews</h3>
                <span class="text-2xl">⭐</span>
            </div>
            <p class="text-3xl font-black text-black">{{ $totalReviews }}</p>
            <p class="text-xs text-gray-700 font-medium">Customer reviews</p>
        </div>

        <!-- Approved Reviews Card -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-6 space-y-3 shadow-lg">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-black text-black uppercase tracking-wide">Approved</h3>
                <span class="text-2xl">✓</span>
            </div>
            <p class="text-3xl font-black text-black">{{ $approvedReviews }}</p>
            <p class="text-xs text-gray-700 font-medium">Published reviews</p>
        </div>

        <!-- Total Revenue Card -->
        <div class="bg-[#E8DCC4] rounded-2xl border-4 border-black p-6 space-y-3 shadow-lg">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-black text-black uppercase tracking-wide">Revenue</h3>
                <span class="text-2xl">💰</span>
            </div>
            <p class="text-3xl font-black text-black">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-700 font-medium">Total earnings</p>
        </div>
    </div>

    <!-- Recent Orders Section -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-black text-black uppercase tracking-wide">Recent Orders</h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.orders.export.pdf') }}?from={{ now()->subDays(30)->format('Y-m-d') }}&to={{ now()->format('Y-m-d') }}" class="bg-blue-800 text-white font-black px-3 py-2 rounded-full text-sm hover:bg-blue-700">Export PDF</a>
                <a href="{{ route('admin.orders.export.excel') }}?from={{ now()->subDays(30)->format('Y-m-d') }}&to={{ now()->format('Y-m-d') }}" class="bg-green-800 text-white font-black px-3 py-2 rounded-full text-sm hover:bg-green-700">Export Excel</a>
                <a href="/admin/orders" class="text-black font-black hover:scale-105 transition-all duration-300 text-sm uppercase tracking-wide">View All →</a>
            </div>
        </div>

        <!-- Recent Orders Table -->
        <div class="bg-white rounded-2xl border-4 border-black overflow-hidden shadow-lg">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-black text-white border-b-2 border-gray-200">
                            <th class="px-6 py-4 text-left text-sm font-black uppercase tracking-wide">Order ID</th>
                            <th class="px-6 py-4 text-left text-sm font-black uppercase tracking-wide">Customer</th>
                            <th class="px-6 py-4 text-left text-sm font-black uppercase tracking-wide">Total Amount</th>
                            <th class="px-6 py-4 text-left text-sm font-black uppercase tracking-wide">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-black uppercase tracking-wide">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse(\App\Models\Order::with('user')->orderBy('tanggal_order', 'desc')->take(5)->get() as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-black text-black">#{{ $order->id }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-black">{{ $order->user->name }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-black">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if($order->status === 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-yellow-100 text-black uppercase tracking-wide">⏳ Pending</span>
                                @elseif($order->status === 'paid')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-green-100 text-black uppercase tracking-wide">✓ Paid</span>
                                @elseif($order->status === 'completed')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-blue-100 text-black uppercase tracking-wide">✓ Completed</span>
                                @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-red-100 text-black uppercase tracking-wide">✕ {{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-700 font-medium">{{ \Carbon\Carbon::parse($order->tanggal_order)->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center">
                                <p class="text-sm text-gray-700 font-medium">No orders yet</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
