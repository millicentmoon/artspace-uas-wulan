<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 

class ArticleController extends Controller
{
    // --- 1. HALAMAN DASHBOARD MEMBER (GRID VIEW) ---
   public function dashboard(Request $request)
    {
        // LOGIKA BARU:
        // Jika Admin -> Ambil artikel buatannya sendiri (untuk diedit)
        // Jika Member -> Ambil SEMUA artikel (untuk dibaca)
        if (Auth::user()->role === 'admin') {
            $query = Article::where('author', Auth::user()->name)->latest();
        } else {
            $query = Article::latest(); // Member melihat semua data
        }

        // --- SISA KODE KE BAWAH SAMA SEPERTI SEBELUMNYA ---
        
        $search = $request->input('search');
        $category = $request->input('category');

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        } elseif ($category) {
            $query->where(function($q) use ($category) {
                $q->where('movement', $category)->orWhere('type', $category);
            });
        }

        $articles = $query->get();

        $featured = $articles->first();
        $others = $articles->skip(1);

        $singlePost = null;
        $searchMessage = null;
        $recommendations = collect();

        if ($search && $featured) {
            $singlePost = $featured;
        }

        if ($articles->isEmpty()) {
            $searchMessage = "Belum ada artikel" . ($search ? " dengan kata kunci '$search'." : ".");
        }

        return view('dashboard', compact('featured', 'others', 'singlePost', 'searchMessage', 'recommendations'));
    }

    // --- FIX: TAMBAHKAN METHOD INDEX ---
    // Method ini menangani route /articles (articles.index)
    // --- HALAMAN KELOLA ARTIKEL (TABEL ADMIN) ---
    public function index()
    {
        // Hanya Admin yang boleh akses halaman ini
        if(auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Hanya admin yang boleh masuk sini!');
        }

        // Ambil semua artikel, urutkan dari yang terbaru, paginasi 10 per halaman
        $articles = Article::latest()->paginate(10);

        return view('articles.index', compact('articles'));
    }

    // --- 2. HALAMAN PUBLIK / VISITOR HOME ---
    public function visitorHome(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');

        $query = Article::latest();

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        } elseif ($category) {
            $query->where('movement', $category)->orWhere('type', $category);
        }

        $articles = $query->get();
        $featured = $articles->first();
        $others = $articles->skip(1)->take(10); 

        $singlePost = ($search && $featured) ? $featured : null;
        $searchMessage = null;
        $recommendations = [];

        if ($articles->isEmpty()) {
            $searchMessage = "Artikel tidak ditemukan.";
            $recommendations = Article::latest()->take(3)->get();
        }

        return view('visitor.index', compact('featured', 'others', 'singlePost', 'searchMessage', 'recommendations'));
    }

    // --- 3. FORM TAMBAH ARTIKEL ---
    public function create()
    {
        return view('articles.create');
    }

    // --- 4. PROSES SIMPAN ARTIKEL (STORE) ---
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'image|file|max:2048',
            'movement' => 'nullable|string',
            'type' => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('article-images', 'public');
        }

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => Auth::user()->name,
            'published_date' => now(),
            'image' => $imagePath,
            'movement' => $request->movement ?? 'Umum',
            'type' => $request->type ?? 'Umum',
        ]);

        return redirect()->route('dashboard')->with('success', 'Artikel berhasil diterbitkan! 🎨');
    }

    // --- 5. FORM EDIT ARTIKEL ---
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        
        if($article->author !== Auth::user()->name) {
             return redirect()->route('dashboard')->with('error', 'Anda tidak berhak mengedit artikel ini.');
        }

        return view('articles.edit', compact('article'));
    }

    // --- 6. PROSES UPDATE ARTIKEL ---
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'image|file|max:2048',
            'movement' => 'nullable|string',
            'type' => 'nullable|string',
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'movement' => $request->movement ?? $article->movement,
            'type' => $request->type ?? $article->type,
        ];

        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $data['image'] = $request->file('image')->store('article-images', 'public');
        }

        $article->update($data);

        return redirect()->route('dashboard')->with('success', 'Artikel berhasil diperbarui! 🚀');
    }

    // --- 7. PROSES HAPUS ARTIKEL ---
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('dashboard')->with('success', 'Artikel berhasil dihapus! 🗑️');
    }

    // --- 8. HALAMAN BACA DETAIL (SHOW) ---
    public function show($id)
    {
        $article = Article::findOrFail($id);
        $related = Article::where('id', '!=', $id)->latest()->take(3)->get();

        return view('visitor.read', compact('article', 'related'));
    }
    public function category($name)
    {
        // Kita gunakan logika yang sama dengan visitorHome
        // tapi kita paksa parameter 'category' diisi dengan $name dari URL
        $request = new Request(['category' => $name]);
        
        return $this->visitorHome($request);
    }
}