<?php


use App\Models\Article;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;


Route::get('/baca/{id}', [ArticleController::class, 'show'])->name('visitor.read');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/', function () {
    $featured = Article::latest()->first();
    $others = Article::latest()->skip(1)->take(6)->get();

    return view('welcome', compact('featured', 'others'));
})->name('home');  
Route::get('/kategori/{name}', [ArticleController::class, 'category'])->name('articles.category');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    
   
    Route::get('/dashboard', [ArticleController::class, 'dashboard'])->name('dashboard');

    
    Route::resource('articles', ArticleController::class);
    
    
Route::middleware(['auth'])->group(function () {
    
    
    Route::get('/home', [ArticleController::class, 'visitorHome'])->name('visitor.home');

   
    Route::get('/read/{article}', [ArticleController::class, 'show'])->name('articles.show');

    Route::get('/dashboard', [ArticleController::class, 'dashboard'])->name('dashboard');

   
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    
   
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

 
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    
   
});
});
