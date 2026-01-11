<?php

namespace App\Http\Controllers;

use App\Models\Article; 
use Illuminate\View\View;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

       
        $singlePost = null;
        $searchMessage = null;
        $recommendations = [];
        $featured = null;
        $others = collect();

        
        if ($search) {
            
            $singlePost = Article::where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%")
                        ->orWhere('author', 'like', "%{$search}%")
                        ->first();

            
            if (!$singlePost) {
                $searchMessage = "Yah, karya yang dicari tidak ada...";
             
                $recommendations = Article::latest()->take(3)->get();
            }
        } 
      
        else {
          
            $featured = Article::latest()->first();

          
            $others = Article::latest()->skip(1)->take(10)->get();
        }

        
        return view('welcome', compact('singlePost', 'searchMessage', 'recommendations', 'featured', 'others'));
    }
}