<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\DB as AttributesDB;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Download;
use App\Models\Favorite;

use Carbon\Carbon;
class DashboardController extends Controller
{

public function index()
{
    // Total counts
    $books = Book::count();
    $users =User::count();
    $downloads =Download::count();
    $favorites =Favorite::count();
    $notifications=Book::where('status','pending')->count('status');
    $newUser=User::where('name_ps','0')->count();
    // Recent books (latest 5)
    $recentBooks = Book::latest()->take(5)->get();

    // Books Uploaded Per Month (last 12 months)
    $booksPerMonth = Book::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->where('created_at', '>=', Carbon::now()->subMonths(12))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    $monthLabels = [];
    $monthData = [];
    for ($i = 0; $i < 12; $i++) {
        $month = Carbon::now()->subMonths(11 - $i);
        $monthLabels[] = $month->format('M');
        $monthData[] = $booksPerMonth->firstWhere('month', $month->month)->total ?? 0;
    }

    $booksPerMonthData = [
        'labels' => $monthLabels,
        'data' => $monthData,
    ];

    // Downloads Per Book (top 10)
    $downloadsByBook = Download::selectRaw('book_id, COUNT(*) as total')
        ->groupBy('book_id')
        ->orderByDesc('total')
        ->take(10)
        ->get();

    $downloadBookIds = $downloadsByBook->pluck('book_id')->toArray();
    $bookTitles = Book::whereIn('id', $downloadBookIds)->pluck('title_en', 'id')->all();

    $downloadBookLabels = [];
    $downloadBookData = [];
    foreach ($downloadsByBook as $stat) {
        $downloadBookLabels[] = Str::limit($bookTitles[$stat->book_id] ?? "Book #{$stat->book_id}", 20);
        $downloadBookData[] = $stat->total;
    }

    $downloadsPerBookData = [
        'labels' => $downloadBookLabels,
        'data' => $downloadBookData,
    ];

    $rolesRaw = User::select('role',DB::raw('COUNT(*) as total'))
                     ->groupBy('role')
                     ->get();

      $rolesData = [
         'labels' => $rolesRaw->pluck('role')->toArray(),
         'data' => $rolesRaw->pluck('total')->toArray(),
      ];

    return view('admin.dashboard', compact(
        'books','users','downloads','favorites','recentBooks','booksPerMonthData','downloadsPerBookData','rolesData',
        'notifications','newUser'
    ));
}

}