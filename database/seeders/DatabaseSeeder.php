<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::create([
            'name' => 'Admin ArtSpace',
            'email' => 'admin@artspace.com',
            'password' => Hash::make('password'), 
            'role' => 'admin',
        ]);

       
        $articles = [
            [
                'title' => 'Rahasia di Balik Senyum Monalisa',
                'movement' => 'Abad Pertengahan', 
                'type' => 'Lukisan',
                'content' => 'Lukisan Monalisa karya Leonardo da Vinci adalah salah satu karya seni paling terkenal di dunia. Misteri senyumannya telah membingungkan para ahli selama berabad-abad. Teknik sfumato yang digunakan memberikan efek kabut yang halus pada wajahnya.',
            ],
            [
                'title' => 'Megahnya Arsitektur Borobudur',
                'movement' => 'Seni Kuno',
                'type' => 'Arsitektur',
                'content' => 'Candi Borobudur adalah monumen Buddha terbesar di dunia. Dibangun pada abad ke-9, candi ini memiliki relief yang menceritakan kehidupan masyarakat Jawa kuno dan ajaran Buddha. Strukturnya yang megah mencerminkan kejayaan masa lalu.',
            ],
            [
                'title' => 'Lukisan Gua Leang-Leang',
                'movement' => 'Seni Prasejarah',
                'type' => 'Lukisan',
                'content' => 'Lukisan cap tangan di gua Leang-Leang, Maros, adalah bukti bahwa seni telah ada sejak ribuan tahun lalu. Lukisan ini diperkirakan berusia lebih dari 40.000 tahun dan menjadi salah satu seni cadas tertua di dunia.',
            ],
            [
                'title' => 'Ekspresionisme Abstrak Jackson Pollock',
                'movement' => 'Modern',
                'type' => 'Desain Digital', 
                'content' => 'Jackson Pollock dikenal dengan teknik "drip painting"-nya yang revolusioner. Ia tidak menggunakan kuas, melainkan meneteskan cat langsung ke kanvas. Ini adalah bentuk kebebasan ekspresi dalam seni modern yang mendobrak aturan tradisional.',
            ],
            [
                'title' => 'Patung David oleh Michelangelo',
                'movement' => 'Abad Pertengahan',
                'type' => 'Patung',
                'content' => 'Patung David adalah mahakarya seni patung Renaisans yang dibuat antara tahun 1501 dan 1504. Patung marmer setinggi 5,17 meter ini menggambarkan tokoh Alkitab, Daud, sesaat sebelum ia melawan Goliat.',
            ],
            [
                'title' => 'Seni Fotografi Hitam Putih',
                'movement' => 'Kontemporer',
                'type' => 'Fotografi',
                'content' => 'Fotografi hitam putih memiliki kekuatan emosional yang unik. Tanpa gangguan warna, fokus pemirsa tertuju pada komposisi, tekstur, dan pencahayaan. Ansel Adams adalah salah satu maestro dalam genre ini.',
            ],
        ];

        
        foreach ($articles as $item) {
            Article::create([
                'title' => $item['title'],
                'content' => $item['content'],
                'author' => 'Admin ArtSpace',
                'published_date' => now(),
                'image' => null,                                                                                     'movement' => $item['movement'],
                'type' => $item['type'],
            ]);
        }
    }
}