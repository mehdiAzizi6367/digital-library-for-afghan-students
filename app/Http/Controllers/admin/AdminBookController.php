<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\NewBookUploaded;
use App\Notifications\BookApproved;
use App\Notifications\BookRejected;
use Illuminate\Support\Facades\Cache;

class AdminBookController extends Controller
{
    // Show all books
    // added cache 
    public function index(Request $request)
{
    $query = Book::with(['category', 'user'])->latest();
    
    $books=Cache::remember('books-page-'.request('page',1),10,function(){return Book::with(['category', 'user'])->latest()->paginate(10);
    });
    $notifications=Book::where('status','pending')->count('status');
    $newUser=User::where('name_ps','0')->count();
    // Search
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('title_en', 'like', "%{$search}%")
              ->orWhere('title_ps', 'like', "%{$search}%")
              ->orWhere('author', 'like', "%{$search}%");
        });
    }

    // Status filter
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Category filter
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    $books = $query->paginate(15);

    // Stats
    $approvedCount = Book::where('status', 'approved')->count();
    $pendingCount  = Book::where('status', 'pending')->count();
    $rejectedCount = Book::where('status', 'rejected')->count();

    // Categories for filter dropdown
    $categories = Category::all();

    return view('admin.books.index', compact(
        'books',
        'approvedCount',
        'pendingCount',
        'rejectedCount',
         'notifications',
         'newUser',
        'categories',
    ));
}
    // Show create form
    public function show()
    {
        $books=cache::remember('books-page-'.request('page',1),60*60,function(){
            return  Book::all();
        });
        $notifications=Book::where('status','pending')->count('status');
        return view('admin.books.pending',compact('books','notifications'));
    }
    public function create()
    {
         $categories =Cache::remember('categories'.request('page',1),60*60,function(){
                return  Category::all();
         });
         $notifications=Book::where('status','pending')->count('status');
         $newUser=User::where('name_ps','0')->count();

        return view('admin.books.create',compact('categories','notifications','newUser'));
    }

    // Store new book
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'edition'=>'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description_en'=>'nullable',
            'file' => 'required|mimes:pdf|max:20480', // max 20MB
        ]);

        $filePath = $request->file('file')->store('books', 'public');
         $filename=$request->file->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('books', $filename);
        $thumbnailPath = $request->file('thumbnail') ? $request->file('thumbnail')->store('thumbnails','public') : null;

       $book=Book::create([
            'title_en' => $request->title_en,
            'author' => $request->author,
            'edition'=>$request->edition,
            'category_id' => $request->category_id,
            'description_en'=>$request->description_en,
            'thumbnail' => $thumbnailPath,
            'uploaded_by' => Auth::id(),
            'file_path' => $filePath,
            'status' => 'approved',
        ]);

        // after saving book
        $admins = User::where('role', 'admin')->get();
        return redirect()->route('admin.books.index')->with('success', 'Book added successfully.');
    }
    public function edit(Book $book)
    {
           $categories = Category::all();
    $newUser=User::where('name_ps','0')->count();

         $notifications=Book::where('status','pending')->count('status');
        return view('admin.books.edit', compact('book','newUser', 'categories','notifications'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title_en'=>'required',
            'title_ps' => 'nullable|string|max:255',
            'title_fa' => 'nullable|string|max:255',
            'description_ps' => 'nullable|string',
            'description_fa' => 'nullable|string',
           
        ]);
        $thumbnailPath = $request->file('thumbnail') ? $request->file('thumbnail')->store('thumbnails','public') : null;

        $book->update([
            'title_ps' => $request->title_ps,
            'title_fa' => $request->title_fa,
            'description_ps' => $request->description_ps,
            'description_fa' => $request->description_fa,
            'title_en'=>$request->title_en,
            'author'=>$request->author,
            'thumbnail' => $thumbnailPath,
            'category_id'=>$request->category_id,
            'description_en'=>$request->description_en,
        ]);
        return redirect()->route('admin.books.edit', $book->id)
        ->with('success', 'Book updated successfully!');
    }

    // Delete book
    public function destroy(Book $book)
    {
        if ($book->file_path) {
            Storage::disk('public')->delete($book->file_path);
        }
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    }
    public function pending()
    {
        $books = Book::where('status', 'pending')->latest()->get();
        $notifications=Book::where('status','pending')->count('status');
       $newUser=User::where('name_ps','0')->count();

        return view('admin.books.pending', compact('books','notifications','newUser'));
    }
    public function approve($id)
    {
        $book = Book::findOrFail($id);

        $book->status = 'approved';
        $book->rejection_reason = null;
        $book->save();
        return back()->with('success', 'Book approved!');
    }

    public function reject($id, request $request)
    {
        $book = Book::findOrFail($id);
        $book->status = 'rejected';
        $book->rejection_reason=$request->reason;
        $book->save();

        return back()->with('error', 'Book rejected!');
    }
    public function translate($id)
    {
        $book=Book::findOrFail($id);
        return view('admin.books.trasnlate',compact('book'));
    }
 

}