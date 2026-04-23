<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('books')->get(); // books relation 
        return view('categories', compact('categories'));
    }
    public function show($id)
    {
        $category = Category::findOrFail($id);

        $books = Book::where('category_id', $id)
            ->where('status', 'approved')
            ->get();

        return view('categories.show', compact('category', 'books'));
    }
     public function create()
    {
        $categories=Category::all();
        return view('user.books.create',compact('categories'));
    }
    public function category() {
        return view('add-category');
        
    }
    
 
}