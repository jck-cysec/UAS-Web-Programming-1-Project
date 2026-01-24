@extends('layouts.admin')

@section('title', 'Manage Orders - Admin')

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
                <h1 class="text-4xl md:text-6xl font-black text-white leading-tight">Orders Management</h1>
                <p class="text-lg md:text-xl text-white/90 font-medium">View and manage customer orders</p>
            </div>
        </div>
        
        <!-- Decorative Element -->
        <div class="absolute top-8 right-8 w-24 h-24 bg-gradient-to-br from-[#FF0080] via-[#FF8C00] to-[#40E0D0] rounded-full opacity-20 blur-3xl"></div>
    </div>
</section>

<div class="space-y-6">
    <!-- Orders Table -->
    <div class="bg-white rounded-2xl border-4 border-black overflow-hidden shadow-lg">
        <div class="px-3 sm:px-6 py-2 sm:py-4 border-b-2 border-black/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 sm:gap-4 overflow-x-auto">
            <form method="GET" class="flex flex-col sm:flex-row items-start sm:items-center gap-2 w-full">
                <label class="text-xs font-black uppercase">From</label>
                <input type="date" name="from" class="border-2 border-black rounded-md px-2 py-1 text-xs sm:text-sm">
                <label class="text-xs font-black uppercase">To</label>
                <input type="date" name="to" class="border-2 border-black rounded-md px-2 py-1 text-xs sm:text-sm">

                <div class="ml-auto flex flex-col sm:flex-row items-start sm:items-center gap-1 sm:gap-2 w-full sm:w-auto">
                    <button formaction="{{ route('admin.orders.export.pdf') }}" class="w-full sm:w-auto inline-flex items-center justify-center bg-blue-800 hover:bg-blue-700 text-white font-black py-2 px-3 sm:px-4 rounded-full transition transform hover:scale-105 shadow-lg text-xs uppercase tracking-wide">
                        PDF
                    </button>
                    <button formaction="{{ route('admin.orders.export.excel') }}" class="w-full sm:w-auto inline-flex items-center justify-center bg-green-800 hover:bg-green-700 text-white font-black py-2 px-3 sm:px-4 rounded-full transition transform hover:scale-105 shadow-lg text-xs uppercase tracking-wide">
                        Excel
                    </button>
                </div>
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-xs sm:text-sm">
                <thead>
                    <tr class="bg-black text-white border-b-2 border-gray-200">
                        <th class="px-2 sm:px-6 py-2 sm:py-4 text-left text-xs font-black uppercase tracking-wide">ID</th>
                        <th class="px-2 sm:px-6 py-2 sm:py-4 text-left text-xs font-black uppercase tracking-wide">Customer</th>
                        <th class="px-2 sm:px-6 py-2 sm:py-4 text-left text-xs font-black uppercase tracking-wide">Amount</th>
                        <th class="px-2 sm:px-6 py-2 sm:py-4 text-left text-xs font-black uppercase tracking-wide">Status</th>
                        <th class="px-2 sm:px-6 py-2 sm:py-4 text-left text-xs font-black uppercase tracking-wide">Date</th>
                        <th class="px-2 sm:px-6 py-2 sm:py-4 text-center text-xs font-black uppercase tracking-wide">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-2 sm:px-6 py-2 sm:py-4 text-xs sm:text-sm font-black text-black">#{{ $order->id }}</td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 text-xs sm:text-sm font-bold text-black">{{ Str::limit($order->user->name ?? 'Unknown', 15) }}</td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 text-xs sm:text-sm font-bold text-black">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4">
                            <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-black bg-black text-white uppercase tracking-wide">
                                {{ Str::limit(ucfirst($order->status), 8) }}
                            </span>
                        </td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 text-xs sm:text-sm font-medium text-gray-700">{{ \Carbon\Carbon::parse($order->tanggal_order)->format('d M') }}</td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4">
                            <div class="flex flex-col sm:flex-row items-center gap-1">
                                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" class="w-full sm:w-auto">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="w-full border-2 border-black rounded-lg bg-white font-medium focus:ring-2 focus:ring-black/50 py-1 px-1 text-xs" onchange="this.form.submit()">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Done</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancel</option>
                                    </select>
                                </form>

                                <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" class="w-full sm:w-auto">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center bg-black hover:bg-black/90 text-white font-black py-1 px-2 sm:px-4 rounded-full transition transform hover:scale-105 shadow-lg text-xs uppercase tracking-wide" onclick="return confirm('Sure?')">
                                        🗑
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-2 sm:px-6 py-4 sm:py-8 text-center">
                            <p class="text-xs sm:text-sm text-gray-500 font-medium">No orders</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection