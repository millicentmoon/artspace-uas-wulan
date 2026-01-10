<?php

namespace App\Http\Controllers;

use App\Models\Article; // Pastikan nama Model sesuai (Article atau Post)
use Illuminate\View\View;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        // 1. Inisialisasi Variabel Default (Agar tidak Error di View)
        $singlePost = null;
        $searchMessage = null;
        $recommendations = [];
        $featured = null;
        $others = collect();

        // 2. LOGIKA: Jika Sedang Mencari
        if ($search) {
            // Cari CUMA SATU data (menggunakan first())
            // Kita cari di judul, isi, atau penulis
            $singlePost = Article::where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%")
                        ->orWhere('author', 'like', "%{$search}%")
                        ->first();

            // Jika Hasil Kosong (Tidak Ketemu)
            if (!$singlePost) {
                $searchMessage = "Yah, karya yang dicari tidak ada...";
                // Ambil 3 rekomendasi artikel terbaru
                $recommendations = Article::latest()->take(3)->get();
            }
        } 
        // 3. LOGIKA: Jika Halaman Depan (Normal/Tidak Mencari)
        else {
            // Ambil 1 artikel terbaru sebagai "Featured Story"
            $featured = Article::latest()->first();

            // Ambil sisanya untuk list di bawah/samping (kecuali yang pertama)
            $others = Article::latest()->skip(1)->take(10)->get();
        }

        // 4. Kirim ke View 'home' (Pastikan nama file view Anda home.blade.php)
        // Jika nama file Anda 'welcome.blade.php', ganti 'home' jadi 'welcome'
        return view('welcome', compact('singlePost', 'searchMessage', 'recommendations', 'featured', 'others'));
    }
}