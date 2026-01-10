<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('articles')->insert([
            [
                'title' => 'Teknik Dasar Melukis dengan Cat Air (Aquarel)',
                'content' => 'Teknik aquarel adalah teknik melukis dengan menggunakan cat air (aquarel) dengan sapuan warna yang tipis, sehingga lukisan yang dihasilkan bernuansa transparan. Agar menghasilkan sapuan yang tipis dan ringan, alangkah baiknya kamu menggunakan cat yang sedikit encer.',
                'published_date' => '2026-01-01',
                'author' => 'Risa Art',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sejarah Lukisan Monalisa Karya Leonardo Da Vinci',
                'content' => 'Monalisa adalah lukisan minyak di atas kayu poplar yang dibuat oleh Leonardo da Vinci pada abad ke-16. Lukisan ini sering dianggap sebagai salah satu lukisan paling terkenal di dunia dan hanya sedikit karya seni lain yang menjadi pusat perhatian, studi, mitologi, dan parodi.',
                'published_date' => '2026-01-05',
                'author' => 'Admin Galeri',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Mengenal Aliran Ekspresionisme',
                'content' => 'Ekspresionisme adalah aliran seni rupa yang menganggap bahwa seni merupakan sesuatu yang keluar dari diri seniman, bukan dari peniruan alam dunia. Seniman memiliki ingatan dan cara pandang tersendiri dari apa yang pernah dilihatnya di alam, lalu diekspresikan pada karyanya.',
                'published_date' => '2026-01-06',
                'author' => 'Pak Guru Seni',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}