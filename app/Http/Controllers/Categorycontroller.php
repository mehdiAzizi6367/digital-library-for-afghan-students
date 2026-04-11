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
         $category = Category::with('books')->findOrFail($id);
         $book=Book::findOrFail($id);
         return view('categories.show', compact('category','book'));
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