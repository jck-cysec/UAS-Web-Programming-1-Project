<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function toggle(Game $game)
    {
        try {
            $wishlist = Wishlist::where('user_id', Auth::id())
                ->where('game_id', $game->id)
                ->first();

            if ($wishlist) {
                $wishlist->delete();
                return back()->with('success', 'Removed from wishlist');
            } else {
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'game_id' => $game->id,
                ]);
                return back()->with('success', 'Added to wishlist');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
    }
}
