<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGames = Game::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalReviews = Review::count();
        $approvedReviews = Review::where('status', 'approved')->count();
        $totalRevenue = Order::where('status', 'paid')->sum('total_harga');

        return view('admin.dashboard', compact(
            'totalGames',
            'totalUsers',
            'totalOrders',
            'pendingOrders',
            'totalReviews',
            'approvedReviews',
            'totalRevenue'
        ));
    }
}
