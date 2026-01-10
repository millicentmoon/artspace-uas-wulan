<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat 1 akun admin
        User::create([
            'name' => 'Admin Galeri',
            'email' => 'admin@artspace.com',
            'password' => Hash::make('password123'), // Passwordnya ini
        ]);
    }
}