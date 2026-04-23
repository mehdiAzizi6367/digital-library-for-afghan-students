<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Download;
use App\Models\Book;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
  public function index()
{
    $userId = auth()->id();
    $totalBooks = Book::where('uploaded_by', $userId)->count();
    $book_reasons=Book::where('status','rejected')->where('uploaded_by',$userId)->count();
    // Use separate downloads table
    $reject_reason=Book::whereNotNull('rejection_reason')->get();
    $downloads =Download::where('user_id', $userId)->count();
    $favorites =Favorite::where('user_id',$userId)->count();
    $categories=Category::all();
    $monthlyUploads = Book::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('count(*) as total')
        )
        ->where('uploaded_by', $userId)
        ->groupBy('month')
        ->get();

    $userBooks = Book::where('uploaded_by', $userId)
        ->with('category')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('user.dashboard', compact(
        'totalBooks',
        'downloads',
        'favorites',
        'monthlyUploads',
        'userBooks',
        'categories',
        'book_reasons'
    ));

    }
   
}
