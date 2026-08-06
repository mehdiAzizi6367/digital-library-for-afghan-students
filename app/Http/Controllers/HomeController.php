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
    
    $categories = Category::latest()
        ->withCount('books')
        ->paginate(8);
    $setting = Setting::first();
    $users=User::all();
    $books = Book::where('status','approved')->latest()->paginate(8);

       return view('home', compact('books', 'categories','setting','users'));
  }
  

}
