<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('game')->get();
        return view('user.cart', compact('carts'));
    }

    public function add(Request $request, Game $game)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('user_id', Auth::id())->where('game_id', $game->id)->first();

        if ($cart) {
            $cart->update(['qty' => $cart->qty + $request->qty]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'game_id' => $game->id,
                'qty' => $request->qty,
            ]);
        }

        return back()->with('success', 'Game added to cart.');
    }

    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $cart->update(['qty' => $request->qty]);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return back()->with('success', 'Item removed from cart.');
    }
}