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
class AdminBookController extends Controller
{
    // Show all books
    public function index()
    {
        $books = Book::with(['category', 'user'])->latest()->paginate(10);
         $notifications=Book::where('status','pending')->count('status');
        //  $user=User::where('name_fa',0)->count('name_ps');
        return view('admin.books.index', compact('books','notifications'));
    }
    // Show create form
    public function show()
    {
        $books=Book::all();
        $notifications=Book::where('status','pending')->count('status');
        return view('admin.books.pending',compact('books','notifications'));
    }
    public function create()
    {
         $categories = Category::all();
         $notifications=Book::where('status','pending')->count('status');
        return view('admin.books.create',compact('categories','notifications'));
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
       $book=Book::create([
            'title_en' => $request->title_en,
            'author' => $request->author,
            'edition'=>$request->edition,
            'category_id' => $request->category_id,
            'description_en'=>$request->description_en,
            'uploaded_by' => Auth::id(),
            'file_path' => $filePath,
            'status' => 'approved',
           
        ]);

        // after saving book
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewBookUploaded($book));
        }
        return redirect()->route('admin.books.index')->with('success', 'Book added successfully.');
    }
    public function edit(Book $book)
    {
         $categories = Category::all();
         $notifications=Book::where('status','pending')->count('status');
        return view('admin.books.edit', compact('book', 'categories','notifications'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title_ps' => 'nullable|string|max:255|required',
            'title_fa' => 'nullable|string|max:255',
            'description_ps' => 'nullable|string',
            'description_fa' => 'nullable|string',
        ]);

        $book->update([
            'title_ps' => $request->title_ps,
            'title_fa' => $request->title_fa,
            'description_ps' => $request->description_ps,
            'description_fa' => $request->description_fa,
            'title_en'=>$request->title_en,
            'author'=>$request->author,
            'isbn'=>$request->isbn,
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
        return view('admin.books.pending', compact('books','notifications'));
    }
    public function approve($id)
    {
        $book = Book::findOrFail($id);

        $book->status = 'approved';
        $book->rejection_reason = null;
        $book->save();

        // 🔔 notify user
        $book->user->notify(new BookApproved($book));
        return back()->with('success', 'Book approved!');
    }

    public function reject($id)
    {
        $book = Book::findOrFail($id);
        $book->status = 'rejected';
        $book->save();

        return back()->with('error', 'Book rejected!');
    }
    public function translate($id)
    {
        $book=Book::findOrFail($id);
        return view('admin.books.trasnlate',compact('book'));
    }


}