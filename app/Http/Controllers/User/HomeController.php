<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Category;
use App\Models\Platform;
use App\Models\Review;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // If an admin is already authenticated, always send them to the admin dashboard
        if (Auth::check() && Auth::user()?->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $request->validate([
            'genre' => 'nullable|string|max:255',
            'platform' => 'nullable|string|max:255',
            'search' => 'nullable|string|max:255',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'sort' => 'nullable|in:price_asc,price_desc,newest',
        ]);

        $query = Game::query();

        $query->when($request->filled('genre'), function ($q) use ($request) {
            $q->where('genre', $request->genre);
        });

        $query->when($request->filled('platform'), function ($q) use ($request) {
            $q->where('platform', $request->platform);
        });

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_game', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('min_price')) {
            $query->where('harga', '>=', (int) $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('harga', '<=', (int) $request->max_price);
        }

        if ($request->filled('sort')) {
            match ($request->sort) {
                'price_asc' => $query->orderBy('harga', 'asc'),
                'price_desc' => $query->orderBy('harga', 'desc'),
                default => $query->orderBy('id', 'desc'),
            };
        } else {
            $query->orderBy('id', 'desc');
        }

        $games = $query->paginate(12)->withQueryString();
        $categories = Category::all();
        $platforms = Platform::all();
        $news = News::orderBy('tanggal', 'desc')->take(5)->get();

        return view('user.home', compact('games', 'categories', 'platforms', 'news'));
    }

    public function games(Request $request)
    {
        $request->validate([
            'genre' => 'nullable|string|max:255',
            'platform' => 'nullable|string|max:255',
            'search' => 'nullable|string|max:255',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'sort' => 'nullable|in:price_asc,price_desc,newest',
        ]);

        $query = Game::query();

        $query->when($request->filled('genre'), function ($q) use ($request) {
            $q->where('genre', $request->genre);
        });

        $query->when($request->filled('platform'), function ($q) use ($request) {
            $q->where('platform', $request->platform);
        });

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_game', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('min_price')) {
            $query->where('harga', '>=', (int) $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('harga', '<=', (int) $request->max_price);
        }

        if ($request->filled('sort')) {
            match ($request->sort) {
                'price_asc' => $query->orderBy('harga', 'asc'),
                'price_desc' => $query->orderBy('harga', 'desc'),
                default => $query->orderBy('id', 'desc'),
            };
        } else {
            $query->orderBy('id', 'desc');
        }

        $games = $query->paginate(12)->withQueryString();
        $categories = Category::all();
        $platforms = Platform::all();

        return view('user.games', compact('games', 'categories', 'platforms'));
    }

    public function show(Game $game)
    {
        return view('user.game-detail', compact('game'));
    }

    public function showNews(News $news)
    {
        return view('user.news-detail', compact('news'));
    }

    public function about()
    {
        $team = [
            [
                'name' => 'Batman',
                'role' => 'Founder & CEO',
                'bio'  => 'Passionate gamer and founder.',
                'image'=> 'https://i.pinimg.com/1200x/a4/c3/70/a4c370803492596dac3c2104cf55acf5.jpg'
            ],
            [
                'name' => 'Red Hood',
                'role' => 'Engineering',
                'bio'  => 'Developers building the storefront.',
                'image'=> 'https://i.pinimg.com/736x/5e/f6/f3/5ef6f3e84dfe79eb72a6f36efbd28c07.jpg'
            ],
            [
                'name' => 'NightWing',
                'role' => 'Customer Support',
                'bio'  => 'Here to help customers.',
                'image'=> 'https://i.pinimg.com/736x/dc/31/59/dc3159c349713b3ddfb602648d8b50a4.jpg'
            ],
        ];

        $achievements = [
            ['label' => 'Users', 'value' => '2.5k+'],
            ['label' => 'Games', 'value' => '250+'],
            ['label' => 'Orders', 'value' => '25k+'],
        ];

        return view('user.about', compact('team', 'achievements'));
    }

    public function storeReview(Request $request, Game $game)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|max:500',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'game_id' => $game->id,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Review submitted for approval.');
    }
}