<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\DB as AttributesDB;
use Illuminate\Support\Facades\DB;

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
     $rolesRaw = User::select('role',DB::raw('COUNT(*) as total'))
                     ->groupBy('role')
                     ->get();

      $rolesData = [
         'labels' => $rolesRaw->pluck('role')->toArray(),
         'data' => $rolesRaw->pluck('total')->toArray(),
      ];

    return view('admin.dashboard', compact(
        'books','users','downloads','favorites','recentBooks','booksPerMonthData','rolesData'
        ,'rolesData','notifications','newUser'));
}

}