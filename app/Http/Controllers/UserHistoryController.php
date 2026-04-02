<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Download;

class UserHistoryController extends Controller
{
    public function index()
    {
        // Get user favorites, sorted by latest
        $userFavorites = Favorite::where('user_id', Auth::id())
            ->with('book')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get user downloads, sorted by latest
        $userDownloads = Download::where('user_id', Auth::id())
            ->with('book')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user-history', compact('userFavorites', 'userDownloads'));
    }
}