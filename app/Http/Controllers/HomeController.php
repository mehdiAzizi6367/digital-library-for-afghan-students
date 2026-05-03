<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Download;
use App\Models\Setting;
use App\Models\User;
class HomeController extends Controller
{

  public function index()
  {
    
    $categories= Category::withCount('books')->get();
    $setting = Setting::first();
    $books = Book::where('status', 'approved')->latest()->paginate(4);

       return view('home', compact('books', 'categories','setting'));
  }
  

}
