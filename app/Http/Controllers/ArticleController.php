<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 

class ArticleController extends Controller
{

   public function dashboard(Request $request)
    {
     
        if (Auth::user()->role === 'admin') {
            $query = Article::where('author', Auth::user()->name)->latest();
        } else {
            $query = Article::latest(); 
        }

   
        
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

  
    public function index()
    {

        if(auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Hanya admin yang boleh masuk sini!');
        }

                                                                                           
        $articles = Article::latest()->paginate(10);

        return view('articles.index', compact('articles'));
    }

 
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


    public function create()
    {
        return view('articles.create');
    }

    
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

    
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        
        if($article->author !== Auth::user()->name) {
             return redirect()->route('dashboard')->with('error', 'Anda tidak berhak mengedit artikel ini.');
        }

        return view('articles.edit', compact('article'));
    }

    
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

    
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('dashboard')->with('success', 'Artikel berhasil dihapus! 🗑️');
    }

    
    public function show($id)
    {
        $article = Article::findOrFail($id);
        $related = Article::where('id', '!=', $id)->latest()->take(3)->get();

        return view('visitor.read', compact('article', 'related'));
    }
    public function category($name)
    {
        
        $request = new Request(['category' => $name]);
        
        return $this->visitorHome($request);
    }
}