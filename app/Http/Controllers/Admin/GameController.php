<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Review;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('created_at', 'desc')->get();
        return view('admin.games.index', compact('games'));
    }

    public function create()
    {
        return view('admin.games.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_game' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|string|max:255',
        ]);

        // Sanitize gambar value to prevent javascript: or data: URI schemes being stored
        $gambar = $request->input('gambar');
        if ($gambar && preg_match('/^(javascript|data):/i', trim($gambar))) {
            $gambar = null; // drop dangerous schemes
        }

        Game::create(array_merge($request->only(['nama_game','genre','platform','harga','deskripsi']), ['gambar' => $gambar]));

        return redirect('/admin/games')->with('success', 'Game berhasil ditambahkan');
    }

    public function edit($id)
    {
        $game = Game::findOrFail($id);
        return view('admin.games.edit', compact('game'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_game' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|string|max:255',
        ]);

        // Sanitize gambar value to prevent javascript: or data: URI schemes being stored
        $gambar = $request->input('gambar');
        if ($gambar && preg_match('/^(javascript|data):/i', trim($gambar))) {
            $gambar = null; // drop dangerous schemes
        }

        $game = Game::findOrFail($id);
        $data = array_merge($request->only(['nama_game','genre','platform','harga','deskripsi']), ['gambar' => $gambar]);
        $game->update($data);

        return redirect('/admin/games')->with('success', 'Game berhasil diupdate');
    }

    public function destroy($id)
    {
        Game::destroy($id);
        return redirect('/admin/games')->with('success', 'Game berhasil dihapus');
    }

    public function reviews()
    {
        $reviews = Review::with(['user', 'game'])->orderBy('created_at', 'desc')->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function approveReview(Review $review)
    {
        $review->update(['status' => 'approved']);
        return back()->with('success', 'Review approved.');
    }

    public function deleteReview(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted.');
    }
}
