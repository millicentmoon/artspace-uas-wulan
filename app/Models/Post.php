<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Pastikan ini sesuai nama tabel di database Anda (misal: posts)
    // Jika tabel Anda namanya 'blog', ganti jadi protected $table = 'blog';
    protected $guarded = ['id']; 
}