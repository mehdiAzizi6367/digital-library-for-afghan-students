<!-- <?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Download;
use App\Models\Favorite;
use App\Models\User;


class BookController extends Controller
{
    /**
     * Display list of books (with optional category filter)
     */
    public function index(Request $request)
    {
        $query = Book::with(['category', 'user'])->latest();
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }
        $books = $query->paginate(12); // paginate 12 per page
        return view('book', compact('books'));
    }
    /**
     * Show form to create new book
     */
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'file' => 'required|mimes:pdf|max:10000',
             'isbn' => [
                    'nullable',
                    'string',
                    'max:20',
                    'unique:books,isbn',
             ],

            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $filePath = null;
        $thumbnailPath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('books','public');
        

        }

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'isbn' => $request->isbn,
            'category_id' => $request->category_id,
            'user_id' => auth::id(),
            'uploaded_by' => auth::id(),
            'file_path' => $filePath,
            'thumbnail' => $thumbnailPath,
            'status'=>'pandding',
        ]);

        return back()->with('success','Book uploaded successfully');
    }
    /*
    *
    *
    *
    *  search for AJAX
    *
    *
    *
    */
    public function search(Request $request)
    {
        $query = $request->query;
        $books = Book::where('title','like',"%$query%")
            ->orWhere('author','like',"%$query%")
            ->get();
        return view('search-results',compact('books','query'));
    }

    /**
     * Search page
     */
    public function searchPage(Request $request)
    {
        $query = $request->query('query');

        $books = Book::where('title', 'LIKE', "%{$query}%")
                    ->orWhere('author', 'LIKE', "%{$query}%")
                    ->paginate(12);

        return view('search-results', compact('books', 'query'));
    }
 

    /**
     * Show single book detail
     */
    public function show($id)
    {
        $book = Book::with(['category', 'user'])->findOrFail($id);

        return view('user.books.show', compact('book'));
    }

    public function download(Book $book)
    {
        // save download record

        Download::create([
            'user_id' => auth::id(),
            'book_id' => $book->id
        ]);

        // download the file
        return Storage::download($book->file_path);
    }

    public function booksChart()
    {
        $books = Book::where('user_id', Auth::id())
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json($books);
    }
    public function userHistory()
    {
        $userFavorites=Favorite::get()->latest()->paginate(8);
        $userDownloads=Download::all();
        return  view('user-history', compact('userFavorites','userDownloads'));
    }
    public function destroy(Favorite $id)
    {
    
        $userFavorites=Favorite::where('user_id', Auth::id());
        $userFavorites->delete();    
    }
    
    public function mybook()
    {
        $userBooks= Book::all();
        return view('user.books.mybooks', compact('userBooks'));
    }
  

   
} 