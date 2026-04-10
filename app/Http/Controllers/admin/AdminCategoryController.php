<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;

class AdminCategoryController extends Controller
{
    // List all categories
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        $notifications=Book::where('status','pending')->count('status');
        return view('admin.categories.index', compact('categories','notifications'));
    }

    // Show create form
    public function create()
    {
         $notifications=Book::where('status','pending')->count('status');
        return view('admin.categories.create',compact('notifications'));
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255|unique:categories,name_en',
            'name_fa' => 'nullable|string|max:255|unique:categories,name_fa',
            'name_ps' => 'nullable|string|max:255|unique:categories,name_ps',
        ]);

        Category::create([
             'name_en' => $request->name_en,
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    // Show edit form
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));  
    }

    // Update category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_en' => "required|string|max:255|unique:categories,name_en,{$category->id}",
            ]);
            $category->name_fa=$request->name_fa;
            $category->name_ps=$request->name_ps;
            $category->name_fa=$request->name_fa;
            $category->save();
            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}