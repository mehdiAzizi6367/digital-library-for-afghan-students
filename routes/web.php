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
use App\Http\Controllers\Admin\SettingController;
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
| Books (Authenticated)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','active'])->group(function(){
    Route::get('/allbooks',[BookController::class,'allBooks'])->name('allbook');
    Route::post('/allbooks',[BookController::class,'download'])->name('allbooks');

    Route::get('/categories/{id}', [CategoryController::class, 'show'])
        ->name('categories.show');

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
| Profile + Live Search
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','active'])->group(function () {

    Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class,'destroy'])->name('profile.destroy');

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
Route::prefix('admin')
    ->middleware(['auth','active','role:admin'])
    ->name('admin.')
    ->group(function () {

    Route::get('/books/pending', [AdminBookController::class, 'pending'])
        ->name('books.pending');

    Route::get('/books/create',[AdminBookController::class,'create'])
        ->name('books.create');

    Route::post('/books/{id}/approve', [AdminBookController::class, 'approve'])
        ->name('books.approve');

    Route::post('/books/{id}/reject', [AdminBookController::class, 'reject'])
        ->name('books.reject');

    Route::get('/books/{book}', [AdminBookController::class, 'show'])
        ->name('books.show')
        ->where('book', '[0-9]+');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('books', AdminBookController::class);
    Route::resource('users', AdminUserController::class);
    Route::resource('categories', AdminCategoryController::class);

    Route::get('/reports', [AdminReportController::class,'index'])
        ->name('reports.index');

    // ✅ Settings
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});

/*
|-------------------------------------------------------------------------- 
| User Routes
|-------------------------------------------------------------------------- 
*/
Route::prefix('user')
    ->middleware(['auth','active','role:user'])
    ->name('user.')
    ->group(function () {

    Route::get('/dashboard', [UserDashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('/books', BookController::class);

    Route::get('downloads', [DownloadController::class, 'index'])
        ->name('downloads.index');

    Route::get('books-chart', [BookController::class, 'booksChart'])
        ->name('books.chart');

    Route::get('/mybooks',[BookController::class,'mybook'])
        ->name('mybook');

    Route::post('/user/favorite',[FavoriteController::class,'index'])
        ->name('favorite');

    Route::get('/add-category',[CategoryController::class,'category'])
        ->name('add-category');
});

/*
|-------------------------------------------------------------------------- 
| Favorites + Downloads
|-------------------------------------------------------------------------- 
*/
Route::middleware(['auth','active'])->group(function () {

    Route::get('/user/favorites', [FavoriteController::class, 'index'])
        ->name('favorites.index');

    Route::post('/books/{book}/favorite', [FavoriteController::class, 'store'])
        ->name('books.favorite');

    Route::delete('/books/{book}/favorite', [FavoriteController::class, 'destroy'])
        ->name('books.unfavorite');

    Route::get('/books/download/{book}', [BookController::class, 'download'])
        ->name('books.download');
});

/*
|-------------------------------------------------------------------------- 
| Other Auth Routes
|-------------------------------------------------------------------------- 
*/
Route::get('/books/{book}/read', [BookController::class, 'read'])
    ->name('books.read')
    ->middleware(['auth','active']);

Route::get('/user/books/create', [CategoryController::class, 'create'])
    ->name('user.books.create')
    ->middleware(['auth','active']);

Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])
    ->name('favorites.destroy')
    ->middleware(['auth','active']);

/*
|-------------------------------------------------------------------------- 
| Extra Features
|-------------------------------------------------------------------------- 
*/
Route::post('/books/{book}/rate', [BookController::class, 'rate'])
    ->name('books.rate');

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ps', 'fa'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::post('/admin/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])
    ->name('admin.users.toggle');

Route::get('/translate/{id}',[AdminBookController::class,'translate'])->name('translate');
Route::get('/trash',[BookController::class,'trash'])->name('book.trash');
Route::get('/restore/{id}',[BookController::class,'restore'])->name('book.restore');
Route::delete('/delete/{id}',[BookController::class,'delete'])->name('book.delete');
Route::get('/rejected-books',[BookController::class,'rejection_reason'])->name('Rj_reason');

require __DIR__.'/auth.php';