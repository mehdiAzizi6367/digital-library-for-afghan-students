<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Download;
use App\Models\Favorite;

class AdminReportController extends Controller
{ 
   public function index()
    {
        // 1️⃣ Downloads per book
        $downloadsRaw = Download::select('book_id', \DB::raw('COUNT(*) as total'))
            ->groupBy('book_id')
            ->with('book') // eager load the related book
            ->get();

        $downloadsData = [
            'labels' => $downloadsRaw->map(fn($d) => $d->book->title ?? 'Unknown')->toArray(),
            'data' => $downloadsRaw->pluck('total')->toArray(),
        ];

        // 2️⃣ Favorites per book
        $favoritesRaw = Favorite::select('book_id', \DB::raw('COUNT(*) as total'))
            ->groupBy('book_id')
            ->with('book')
            ->get();
         

        $favoritesData = [
            'labels' => $favoritesRaw->map(fn($f) => $f->book->title ?? 'Unknown')->toArray(),
            'data' => $favoritesRaw->pluck('total')->toArray(),
        ];


        // 3️⃣ Pass to Blade
        return view('admin.reports.index', compact('downloadsData', 'favoritesData'));
    }
}