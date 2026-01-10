<?php


use App\Models\Article;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;


Route::get('/baca/{id}', [ArticleController::class, 'show'])->name('visitor.read');
// --- ROUTE PENDAFTARAN (REGISTER) ---
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
// 1. Jalur Publik (Halaman Depan)
Route::get('/', function () {
    $featured = Article::latest()->first();
    $others = Article::latest()->skip(1)->take(6)->get();

    return view('welcome', compact('featured', 'others'));
})->name('home');  // <--- TAMBAHKAN INI (JANGAN LUPA TITIK KOMA ';')
// Route untuk filter kategori (Seni Kuno, Lukisan, dll)
Route::get('/kategori/{name}', [ArticleController::class, 'category'])->name('articles.category');

// 2. Jalur Login/Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. Jalur Admin (Harus Login)
// --- JALUR ADMIN (Hanya bisa diakses setelah Login) ---
Route::middleware(['auth'])->group(function () {
    
    // 1. Dashboard Utama -> Arahkan ke method 'dashboard'
    Route::get('/dashboard', [ArticleController::class, 'dashboard'])->name('dashboard');

    // 2. Kelola Artikel -> Ini otomatis mengarah ke method 'index' dll
    Route::resource('articles', ArticleController::class);
    
    // --- ROUTE KHUSUS MEMBER (SUDAH LOGIN) ---
Route::middleware(['auth'])->group(function () {
    
    // 1. Dashboard Pengunjung (Halaman Utama Member)
    Route::get('/home', [ArticleController::class, 'visitorHome'])->name('visitor.home');

    // 2. Halaman Baca Artikel Full (Detail)
    Route::get('/read/{article}', [ArticleController::class, 'show'])->name('articles.show');

    Route::get('/dashboard', [ArticleController::class, 'dashboard'])->name('dashboard');

    // 2. Form Tambah Artikel (Create)
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    
    // 3. Proses Simpan Artikel ke Database (Store)
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

    // 4. Proses Hapus Artikel (Delete)
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    
    // (Fitur Edit kita buat setelah ini berhasil)
});
});
