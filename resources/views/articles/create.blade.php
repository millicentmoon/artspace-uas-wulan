<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Karya Baru - ArtSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #FFFBEB; }
        h1, h2, h3, .font-ceria { font-family: 'Fredoka', sans-serif; }
    </style>
</head>
<body class="bg-yellow-50 py-10 px-6">

    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-ceria text-gray-800">🎨 Tambah Karya Baru</h1>
            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-pink-500 font-bold transition flex items-center gap-2">
                ⬅️ Batal & Kembali
            </a>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-xl border-4 border-white ring-4 ring-pink-100">
            
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-gray-700 font-bold mb-2 font-ceria text-lg">Judul Karya</label>
                    <input type="text" name="title" value="{{ old('title') }}" 
                           class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl p-3 focus:outline-none focus:border-pink-400 focus:bg-white transition font-bold text-gray-700 placeholder-gray-300" 
                           placeholder="Contoh: Senja di Pelabuhan Ratu" required>
                    @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2 font-ceria">Gerakan Seni</label>
                        <select name="movement" class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl p-3 focus:outline-none focus:border-blue-400 focus:bg-white transition font-bold text-gray-600 cursor-pointer">
                            <option value="Seni Kuno">🏺 Seni Kuno</option>
                            <option value="Seni Prasejarah">🦖 Seni Prasejarah</option>
                            <option value="Abad Pertengahan">🏰 Abad Pertengahan</option>
                            <option value="Modern">🏙️ Seni Modern</option>
                   
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2 font-ceria">Bentuk Seni</label>
                        <select name="type" class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl p-3 focus:outline-none focus:border-blue-400 focus:bg-white transition font-bold text-gray-600 cursor-pointer">
                            <option value="Lukisan">🎨 Lukisan</option>
                            <option value="Patung">🗿 Patung</option>
                            <option value="Desain Digital">💻 Desain Digital</option>
                            <option value="Fotografi">📸 Fotografi</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2 font-ceria">Upload Gambar Karya</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:bg-gray-50 transition cursor-pointer relative">
                        <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewImage(event)">
                        <div id="preview-container">
                            <span class="text-4xl block mb-2">🖼️</span>
                            <span class="text-gray-400 font-bold">Klik untuk pilih gambar (Max 2MB)</span>
                        </div>
                        <img id="preview-img" class="hidden max-h-64 mx-auto rounded-lg mt-2 shadow-sm">
                    </div>
                    @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2 font-ceria text-lg">Cerita di Balik Karya</label>
                    <textarea name="content" rows="6" 
                              class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl p-3 focus:outline-none focus:border-pink-400 focus:bg-white transition text-gray-700 leading-relaxed" 
                              placeholder="Tuliskan deskripsi, makna, atau cerita menarik tentang karya ini..." required>{{ old('content') }}</textarea>
                    @error('content') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <hr class="border-dashed border-gray-200">

                <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-orange-400 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.02] transition transform duration-200 text-lg">
                    🚀 Terbitkan Karya Sekarang!
                </button>

            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('preview-img');
                const container = document.getElementById('preview-container');
                output.src = reader.result;
                output.classList.remove('hidden');
                container.classList.add('hidden');
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

</body>
</html>