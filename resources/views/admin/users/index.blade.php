@extends('layouts.admin')

@section('title', 'Manage Users - Admin')

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
                <h1 class="text-4xl md:text-6xl font-black text-white leading-tight">Users</h1>
                <p class="text-lg md:text-xl text-white/90 font-medium">Manage user accounts and roles</p>
            </div>
        </div>
        
        <!-- Decorative Element -->
        <div class="absolute top-8 right-8 w-24 h-24 bg-gradient-to-br from-[#FF0080] via-[#FF8C00] to-[#40E0D0] rounded-full opacity-20 blur-3xl"></div>
    </div>
</section>

<div class="space-y-6">
    <!-- Users Table -->
    <div class="bg-white rounded-2xl border-4 border-black overflow-hidden shadow-lg">
        <div class="overflow-x-auto">
            <table class="w-full text-xs sm:text-sm">
                <thead>
                    <tr class="bg-black text-white border-b-2 border-gray-200">
                        <th class="px-2 sm:px-6 py-2 sm:py-4 text-left text-xs font-black uppercase tracking-wide">#</th>
                        <th class="px-2 sm:px-6 py-2 sm:py-4 text-left text-xs font-black uppercase tracking-wide">Name</th>
                        <th class="hidden sm:table-cell px-2 sm:px-6 py-2 sm:py-4 text-left text-xs font-black uppercase tracking-wide">Email</th>
                        <th class="hidden md:table-cell px-2 sm:px-6 py-2 sm:py-4 text-left text-xs font-black uppercase tracking-wide">Username</th>
                        <th class="px-2 sm:px-6 py-2 sm:py-4 text-left text-xs font-black uppercase tracking-wide">Role</th>
                        <th class="px-2 sm:px-6 py-2 sm:py-4 text-center text-xs font-black uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-2 sm:px-6 py-2 sm:py-4 text-xs sm:text-sm font-black text-black">{{ $loop->iteration }}</td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 text-xs sm:text-sm font-bold text-black">{{ Str::limit($user->name, 15) }}</td>
                        <td class="hidden sm:table-cell px-2 sm:px-6 py-2 sm:py-4 text-xs sm:text-sm font-medium text-gray-700 break-words">{{ Str::limit($user->email, 20) }}</td>
                        <td class="hidden md:table-cell px-2 sm:px-6 py-2 sm:py-4 text-xs sm:text-sm font-medium text-gray-700">{{ Str::limit($user->username, 12) }}</td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 text-xs">
                            <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-black bg-black text-white uppercase tracking-wide">
                                {{ Str::limit(ucfirst($user->role), 8) }}
                            </span>
                        </td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4">
                            <form method="POST" action="{{ route('admin.users.updateRole', $user) }}" class="inline-flex flex-col sm:flex-row items-center justify-center gap-1 sm:gap-2 w-full sm:w-auto">
                                @csrf
                                @method('PATCH')
                                <select name="role" class="w-full sm:w-auto border-2 border-black rounded-lg bg-white text-black font-medium focus:outline-none focus:ring-2 focus:ring-black/50 py-1 sm:py-2 px-2 sm:px-3 text-xs uppercase tracking-wide">
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center bg-black hover:bg-black/90 text-white font-black py-1 sm:py-2 px-3 sm:px-4 rounded-full transition transform hover:scale-105 shadow-lg text-xs uppercase tracking-wide">Upd</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center">
                            <p class="text-sm text-gray-500 font-medium">No users found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection