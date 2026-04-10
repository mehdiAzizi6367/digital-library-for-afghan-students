<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewBookUploaded;
use Illuminate\Support\Str;
use App\Models\Download;
use App\Models\Favorite;
use App\Models\Category;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Global_;

class BookController extends Controller
{
    /**
     * Display a listing of the user's own books
     */
    public function index()
    {
        // latest() orders by newest first, paginate(10) shows 10 per page
        $userBooks = Book::where('uploaded_by', Auth::id())->latest()->paginate(8); 
         $user=User::where('name_ps',0)->count('name_ps');
        $categories=Category::all();
        return view('user.books.index', compact('userBooks','categories','user'));
    }

    /**
     * Show the form for creating a new book
     */
       /**
     * Store a newly created book in storage
     */
  public function store(Request $request)
{
    // 1️⃣ Validate user input (English only)
    $request->validate([
        'title_en' => 'required|string|max:255',
        'description_en' => 'nullable|string',
        'author' => 'required|string|max:255',
        'edition' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'file' => 'required|mimes:pdf,epub|max:10240', // 10MB
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'isbn' => 'nullable|string|max:255',
    ]);
    // 2️⃣ Handle file upload
     $filename=$request->file->getClientOriginalName();
    $filePath = $request->file('file')->storeAs('books', $filename);
    $thumbnailPath = $request->file('thumbnail') ? $request->file('thumbnail')->store('thumbnails','public') : null;

    // 3️⃣ Create book record
    // 4️⃣ Redirect with success message 
    
    
     $books=Book::all();
     foreach($books as $tbook)
    {   Global $tbook;
        //  dd($tbook->author);
    
    }
        //  dd($tbook->author);
        //  dd($request->author);
        //  dd($request->title_en);
        //  dd($request->edition);
     if($tbook->author == $request->author && $tbook->title_en ==$request->title_en && $tbook->edition == $request->edition)
    {
        // $msg ="<div class='badge bg-danger'>Book is already exist</div>" ;
        return redirect()->route('user.books.create')->with('success', __('Book is already exist choose diffirent one'));;
        
    }else{
        $book = Book::create([
    
            'title_en' => $request->title_en,
            'description_en' => $request->description_en,
            'author' => $request->author,
            'edition'=>$request->edition,
            'category_id' => $request->category_id,
            'file_path' => $filePath,
            'thumbnail' => $thumbnailPath,
            'isbn' => $request->isbn,
            'uploaded_by' => auth::id(),    
            // ✅ Leave translations NULL for now
            'title_ps' => null,
            'title_fa' => null,
            'description_ps' => null,
            'description_fa' => null,
        ]);
        if(isset($msg)?? ' ');
        return redirect()->route('user.books.index')->with('success', __('message.book_added_success'));
    }
  
}

    /**
     * Display a single book
     */
    public function show(Book $book)
    {
        // Only allow approved books for non-owners
        if ($book->status !== 'approved') {
            abort(404); // hide unapproved books
        }
        $user=User::where('name_ps',0)->count('name_ps');
        return view('user.books.show', compact('book','user'));
    }

    public function read($id)
    {
        $book = Book::findOrFail($id);
        return view('books.read', compact('book'));
    }

    /**
     * Show the form for editing the book
     */
    public function edit(Book $book)
    {
        // Only the uploader can edit
        if ($book->uploaded_by !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $categories =Category::all();
        return view('user.books.edit', compact('book','categories')); 
    }
    /**
     * Update the book in storage
     */
    public function update(Request $request, Book $book)
    {
        // Only uploader can update
        if ($book->uploaded_by !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        // Validate request
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'isbn' => 'nullable|string|unique:books,isbn,' . $book->id,
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'file'        => 'nullable|file|mimes:pdf',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Replace PDF if new uploaded
        if ($request->hasFile('file')) {

            if ($book->file_path) {
                Storage::disk('public')->delete($book->file_path);
            }

            $validated['file_path'] = $request->file('file')->store('books', 'public');
        }

        // Replace Thumbnail if new uploaded
        if ($request->hasFile('thumbnail')) {
        
            if ($book->thumbnail) {
                Storage::disk('public')->delete($book->thumbnail);
            }

            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
        $validated['status'] = 'pending';
        // Update book
        $book->update($validated);

        return redirect()->route('user.books.index')
            ->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the book from storage
     */
    public function destroy(Book $book)
    {
        // Only uploader can delete
        if ($book->uploaded_by !== Auth::id()) {
            abort(403, 'Unauthorized !  you are not allow to access this page.');
        }
              
        // Delete files if exist
        if ($book->file_path && Storage::disk('public')->exists($book->file_path)) {
            Storage::disk('public')->delete($book->file_path);
        }

        if ($book->thumbnail && Storage::disk('public')->exists($book->thumbnail)) {
            Storage::disk('public')->delete($book->thumbnail);
        }

        $book->delete();

        return redirect()->back();
    }
    public function booksChart()
    {
        $books = Book::where('uploaded_by', Auth::id())
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json($books);
    }

    public function mybook()
    {
        $books = Book::where('uploaded_by', auth::id())->latest()->get();
        // $books= Book::all();
        return view('user.books.mybooks', compact('books'));
    }
    public function allBooks()
    {
        $books=Book::where('status','approved')->paginate(12);
        $categories=Category::all();
        $Books=Book::count();
        $Categories=Category::all();
        $Students=User::count();
        $Downloads=Download::count();
        return view('book',compact('books','categories'));
    }
     public function userHistory()
    {
        $userFavorites = Favorite::where('user_id', Auth::id())->get();
        $userDownloads = Download::where('user_id', Auth::id())->get();
        return  view('user-history', compact('userFavorites','userDownloads'));
    }

    // same method is define out of the user directory too in the bookController
     public function searchPage(Request $request)
    {
        $query = $request->query('query');
        $books = Book::where('status', 'approved')
                    ->where(function ($q) use ($query) {
                        $q->where('title_en', 'LIKE', "%{$query}%")
                        ->orWhere('author', 'LIKE', "%{$query}%");
                    })
                    ->paginate(12);
        return view('search-results', compact('books', 'query'));
    }
    
    // method for notification 
        public function toggleFavorite($bookId)
    {
        $favorite = Favorite::where('user_id', auth::id())
            ->where('book_id', $bookId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Removed from favorites');
        } else {
            Favorite::create([
                'user_id' => auth::id(),
                'book_id' => $bookId
            ]);

            return back()->with('success', 'Added to favorites');
        }
    }
    public function download($id)
    {
        $book = Book::findOrFail($id);
          $alreadyDownloaded = DB::table('downloads')
            ->where('user_id', auth::id())
            ->where('book_id', $book->id)
            ->exists();

        if (!$alreadyDownloaded) {
            DB::table('downloads')->insert([
                'user_id' => auth::id(),
                'book_id' => $book->id,
                'created_at' => now(),
            ]);
        }

        $filePath = storage_path('app/public/' . $book->file_path);
        // dd($filePath);
        

        if (!file_exists($filePath)) {
            dd($filePath); // DEBUG (see exact path)
        }

        return response()->download($filePath);
    }

    public function rate(Request $request, $bookId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

            Rating::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'book_id' => $bookId
            ],
            [
                'rating' => $request->rating
            ]
        );

        return response()->json([
            'success' => true
        ]);
    }

}
