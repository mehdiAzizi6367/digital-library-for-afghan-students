<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\BookController;
use App\Http\Controllers\User\UserDashboardController;

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\adminController;

use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Book;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/welcome', fn() => view('welcome'));
Route::get('/about', fn() => view('about'))->name('about');

Route::get('/contact', fn() => view('contact'))->name('contact');
Route::post('/contact', [ContactController::class,'store'])->name('contact.store');
/*
|--------------------------------------------------------------------------
| Books Public Routes
|--------------------------------------------------------------------------
*/
route::middleware('auth')->group(function(){
    route::get('/allbooks',[BookController::class,'allBooks'])->name('allbooks');
    route::post('/allbooks',[BookController::class,'download'])->name('allbooks');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])
    ->name('categories.show');
});
route::middleware('auth')->group(function(){
    Route::get('/books', [BookController::class,'index'])->name('books.index');
    Route::get('/books/search', [BookController::class,'search'])->name('books.search');
    Route::get('/search', [BookController::class,'searchPage'])->name('search.page');
    Route::get('/books/{book}', [BookController::class,'show'])->name('books.show');
});

/*
|--------------------------------------------------------------------------
| Categories
|--------------------------------------------------------------------------
*/
Route::get('/categories', [CategoryController::class,'index'])->name('categories.index');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes (common for all roles)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class,'destroy'])->name('profile.destroy');
    // Search books for live search

    Route::get('/search-books', function(Request $request){
        $query = $request->input('query');
        $books = Book::where('title_en','LIKE',"%{$query}%")
            ->orWhere('title_ps','LIKE',"%{$query}%")
            ->orWhere('title_fa','LIKE',"%{$query}%")
            ->orWhere('author','LIKE',"%{$query}%")
            ->limit(6)
            ->get();
        return response()->json($books);
    });
});
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth','role:admin'])->name('admin.')->group(function () {
    // 📋 Pending books
    Route::get('/books/pending', [AdminBookController::class, 'pending'])
    ->name('books.pending');
    route::get('/books/create',[AdminBookController::class,'create'])->name('books.create');
    // ✅ Approve
    // route::get('/books/pending',[AdminBookController::class,'index'])->name('books.pending');
    Route::post('/books/{id}/approve', [AdminBookController::class, 'approve'])
        ->name('books.approve');
    // ❌ Reject
    Route::post('/books/{id}/reject', [AdminBookController::class, 'reject'])
        ->name('books.reject');
    // 📖 Show book (IMPORTANT FIX)
    Route::get('/books/{book}', [AdminBookController::class, 'show'])
        ->name('books.show')
        ->where('book', '[0-9]+'); // 🔥 IMPORTANT
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Books CRUD
    Route::resource('books', AdminBookController::class);
    // Users CRUD
    Route::resource('users', AdminUserController::class);
    // Categories CRUD
    Route::resource('categories', AdminCategoryController::class);
    // Reports
    Route::get('/reports', [AdminReportController::class,'index'])->name('reports.index');
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::prefix('user')->middleware(['auth','role:user'])->name('user.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // User Books CRUD
    Route::resource('/books', BookController::class);

    // Downloads
    Route::get('downloads', [DownloadController::class, 'index'])->name('downloads.index');
   
    // Route for books chart (AJAX)
    Route::get('books-chart', [BookController::class, 'booksChart'])->name('books.chart');
    route::get('/mybooks',[BookController::class,'mybook'])->name('mybook');
    route::post('/user/favorite',[FavoriteController::class,'index'])->name('favorite');

    // new added routes
   route::get('/add-category',[CategoryController::class,'category'])->name('add-category');

});

Route::middleware('auth')->group(function () {

    // Show favorites page
    Route::get('/user/favorites', [FavoriteController::class, 'index'])
        ->name('favorites.index');

    // Add to favorite
    Route::post('/books/{book}/favorite', [FavoriteController::class, 'store'])
        ->name('books.favorite');
    // Remove from favorite
    Route::delete('/books/{book}/favorite', [FavoriteController::class, 'destroy'])
        ->name('books.unfavorite');
});
Route::middleware('auth')->group(function () {
    Route::get('/books/download/{book}', [BookController::class, 'download'])
        ->name('books.download');
});
Route::get('/books/{book}/read', [BookController::class, 'read'])->name('books.read')->middleware('auth');
Route::get('/user/books/create', [CategoryController::class, 'create'])->name('user.books.create')->middleware('auth');
route::get('/user-history', [BookController::class,'userHistory'])->name('user.history')->middleware('auth');
Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])
    ->name('favorites.destroy')
    ->middleware('auth');

// ratting system
Route::post('/books/{book}/rate', [BookController::class, 'rate'])
    ->name('books.rate');
// language switch route
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ps', 'fa'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('books/{book}/edit', [AdminBookController::class, 'edit'])->name('books.edit');
    Route::put('books/{book}', [AdminBookController::class, 'update'])->name('books.update');
});
Route::post('/admin/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])
    ->name('admin.users.toggle');
route::get('/translate/{id}',[AdminBookController::class,'translate'])->name('translate');

route::get('/rejected-books',[BookController::class,'rejection_reason'])->name('Rj_reason');
require __DIR__.'/auth.php';
