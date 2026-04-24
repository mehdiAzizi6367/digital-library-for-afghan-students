<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Download;
use App\Models\User;
class HomeController extends Controller
{

  public function index()
  {
    
    $categories= Category::withCount('books')->get();
    $books = Book::where('status', 'approved')->latest()->paginate(4);
  
       return view('home', compact('books', 'categories'));
  }
  

}
