<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel - ArtSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Nunito', sans-serif; background-color: #FFFBEB; } .font-ceria { font-family: 'Fredoka', sans-serif; }</style>
</head>
<body class="p-8 flex justify-center items-center min-h-screen">

    <div class="w-full max-w-2xl bg-white rounded-[2rem] shadow-2xl border-4 border-blue-300 overflow-hidden">
        <div class="bg-blue-100 p-6 border-b-2 border-blue-200 text-center">
            <h1 class="text-3xl font-ceria text-blue-600">✏️ Edit Karya</h1>
        </div>
        
        <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-gray-500 font-bold mb-2">Judul Artikel</label>
                <input type="text" name="title" value="{{ $article->title }}" class="w-full p-4 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-400 focus:bg-white outline-none font-bold text-gray-700" required>
            </div>

            <div>
                <label class="block text-gray-500 font-bold mb-2">Nama Penulis</label>
                <input type="text" name="author" value="{{ $article->author }}" class="w-full p-4 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-400 focus:bg-white outline-none font-bold text-gray-700" placeholder="Nama penulis..." required>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <div>
                    <label class="block text-gray-500 font-bold mb-2">Gerakan Seni</label>
                    <div class="relative">
                        <select name="movement" class="w-full p-4 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-400 focus:bg-white outline-none font-bold text-gray-700 appearance-none cursor-pointer" required>
                            <option value="Seni Kuno" {{ $article->movement == 'Seni Kuno' ? 'selected' : '' }}>🏺 Seni Kuno</option>
                            <option value="Seni Prasejarah" {{ $article->movement == 'Seni Prasejarah' ? 'selected' : '' }}>🦖 Seni Prasejarah</option>
                            <option value="Abad Pertengahan" {{ $article->movement == 'Abad Pertengahan' ? 'selected' : '' }}>🏰 Abad Pertengahan</option>
                            <option value="Modern" {{ $article->movement == 'Modern' ? 'selected' : '' }}>🏙️ Seni Modern</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">▼</div>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-500 font-bold mb-2">Bentuk Seni</label>
                    <div class="relative">
                        <select name="type" class="w-full p-4 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-400 focus:bg-white outline-none font-bold text-gray-700 appearance-none cursor-pointer" required>
                            <option value="Lukisan" {{ $article->type == 'Lukisan' ? 'selected' : '' }}>🎨 Lukisan</option>
                            <option value="Patung" {{ $article->type == 'Patung' ? 'selected' : '' }}>🗿 Patung</option>
                            <option value="Arsitektur" {{ $article->type == 'Arsitektur' ? 'selected' : '' }}>🏛️ Arsitektur</option>
                            <option value="Fotografi" {{ $article->type == 'Fotografi' ? 'selected' : '' }}>📸 Fotografi</option>
                            <option value="Desain Digital" {{ $article->type == 'Desain Digital' ? 'selected' : '' }}>💻 Desain Digital</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">▼</div>
                    </div>
                </div>

            </div>

            <div>
                <label class="block text-gray-500 font-bold mb-2">Foto Sampul</label>
                
                @if($article->image)
                    <div class="mb-3 p-2 border-2 border-dashed border-gray-300 rounded-xl inline-block bg-gray-50">
                        <p class="text-xs text-gray-400 mb-1">Foto Saat Ini:</p>
                        <img src="{{ asset('storage/' . $article->image) }}" class="h-32 w-auto rounded-lg object-cover">
                    </div>
                @endif

                <input type="file" name="image" class="w-full p-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-400 text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer">
                <p class="text-xs text-gray-400 mt-1 ml-2">*Biarkan kosong jika tidak ingin mengganti foto.</p>
            </div>

            <div>
                <label class="block text-gray-500 font-bold mb-2">Isi Cerita</label>
                <textarea name="content" rows="6" class="w-full p-4 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-400 focus:bg-white outline-none text-gray-600" required>{{ $article->content }}</textarea>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('articles.index') }}" class="w-1/3 text-center py-3 rounded-xl bg-gray-200 text-gray-600 font-bold hover:bg-gray-300 transition">Batal</a>
                <button type="submit" class="w-2/3 py-3 rounded-xl bg-gradient-to-r from-blue-400 to-indigo-400 text-white font-bold shadow-lg hover:scale-105 transition transform">💾 SIMPAN PERUBAHAN</button>
            </div>
        </form>
    </div>

</body>
</html>