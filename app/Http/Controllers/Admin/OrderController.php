<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'orderItems.game'])->orderBy('tanggal_order', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,completed,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated.');
    }

    /**
     * Remove the specified order.
     */
    public function destroy(Order $order)
    {
        // Delete related order items first for data consistency
        $order->orderItems()->delete();
        $order->delete();

        return back()->with('success', 'Order deleted successfully.');
    }
}