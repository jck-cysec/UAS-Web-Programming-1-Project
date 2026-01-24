<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('orderItems.game')->get();
        return view('user.orders', compact('orders'));
    }

    public function checkout(Request $request)
    {
        $carts = Cart::where('user_id', Auth::id())->with('game')->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Cart is empty.');
        }

        $total = $carts->sum(function ($cart) {
            return $cart->qty * $cart->game->harga;
        });

        DB::transaction(function () use ($carts, $total) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_harga' => $total,
                'status' => 'pending',
                'tanggal_order' => now(),
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'game_id' => $cart->game_id,
                    'qty' => $cart->qty,
                    'harga' => $cart->game->harga,
                ]);
            }

            Cart::where('user_id', Auth::id())->delete();
        });

        return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('orderItems.game');
        return view('user.order-detail', compact('order'));
    }

    /**
     * Allow the owner to delete their order
     */
    public function destroy(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete order items first
        $order->orderItems()->delete();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}