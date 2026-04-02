<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.favorites.index', compact("favorites"));
    }

    public function store($book_id)
    {
        Favorite::firstOrCreate([
            'user_id' => auth()->id(),
            'book_id' => $book_id
        ]);

        return back()->with('success', 'Book added to favorites');
    }

    public function destroy($book_id)
    {
        Favorite::where('user_id', auth()->id())
            ->where('book_id', $book_id)
            ->delete();

        return back()->with('success', 'Favorite removed successfully');
    }
}

