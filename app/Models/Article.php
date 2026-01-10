<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // KUNCI MASALAHNYA ADA DI SINI
    // Kita harus mendaftarkan 'image' agar bisa disimpan ke database
   protected $fillable = [
    'title', 
    'content', 
    'author', 
    'published_date',
    'image',
    'movement', // <--- Tambahan Baru
    'type'      // <--- Tambahan Baru
];
}