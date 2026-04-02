<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Download;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    // Show all downloads for current user
    public function index()
    {
        $downloads = Download::where('user_id', Auth::id())->with('book')->get();
        return view('user.downloads.index', compact('downloads'));
    }

    // Store a new download (when user downloads a book)
    public function store($book_id)
    {
        Download::create([
            'user_id' => Auth::id(),
            'book_id' => $book_id
        ]);

        return back()->with('success', 'Book downloaded successfully');
    }

    public function download($id)
    {
        $book = Book::findOrFail($id);

        Download::create([
            'user_id' => auth::id(),
            'book_id' => $book->id
        ]);

        return Storage::download($book->file);
    }
}