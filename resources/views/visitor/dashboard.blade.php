<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Member - ArtSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #FFFBEB; } 
        h1, h2, h3, .font-ceria { font-family: 'Fredoka', sans-serif; }
    </style>
</head>
<body class="bg-yellow-50">

    <nav class="bg-white border-b-4 border-pink-300 py-4 px-6 flex justify-between items-center shadow-sm sticky top-0 z-50">
        <div class="font-ceria font-bold text-xl text-gray-700">ArtSpace <span class="text-pink-500">Studio</span></div>
        <div class="flex gap-4 items-center">
            <span class="font-bold text-gray-500 hidden md:inline">Halo, {{ Auth::user()->name }}! 👋</span>
            <a href="{{ route('visitor.home') }}" class="text-sm text-blue-500 hover:underline bg-blue-50 px-3 py-1 rounded-full">Lihat Web Publik</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-red-100 text-red-500 px-4 py-1 rounded-full font-bold hover:bg-red-200 text-sm transition">Keluar</button>
            </form>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto p-6">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 mt-4 gap-4">
            <div>
                <h1 class="text-3xl font-ceria text-gray-800">Galeri Karyamu</h1>
                <p class="text-gray-500">Kelola semua artikel dan karya senimu di sini.</p>
            </div>
            <a href="{{ route('articles.create') }}" class="bg-gradient-to-r from-pink-500 to-orange-400 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:scale-105 transition flex items-center gap-2">
                <span>➕</span> Buat Karya Baru
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow-sm animate-pulse" role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-[1.5rem] shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto"> <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 uppercase text-xs leading-normal">
                            <th class="py-4 px-6 font-bold">Gambar</th>
                            <th class="py-4 px-6 font-bold">Detail Artikel</th>
                            <th class="py-4 px-6 font-bold">Tanggal</th>
                            <th class="py-4 px-6 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-bold">
                        @forelse($articles as $item)
                        <tr class="border-b border-gray-100 hover:bg-yellow-50 transition">
                            <td class="py-3 px-6 text-left align-middle w-24">
                                <div class="w-16 h-16 rounded-lg overflow-hidden border border-gray-200 shadow-sm relative">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="https://picsum.photos/seed/{{ $item->id }}/100/100" class="w-full h-full object-cover">
                                    @endif
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left align-middle">
                                <span class="text-gray-800 text-base font-ceria block mb-1">{{ $item->title }}</span>
                                <span class="text-xs text-gray-400 font-normal truncate max-w-xs block">
                                    {{ \Illuminate\Support\Str::limit($item->content, 60) }}
                                </span>
                                <span class="text-[10px] text-pink-400 font-bold uppercase mt-1 inline-block">
                                    {{ $item->author ?? 'Penulis' }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-left align-middle">
                                <span class="bg-blue-100 text-blue-600 py-1 px-3 rounded-full text-xs whitespace-nowrap">
                                    {{ $item->created_at->format('d M Y') }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center align-middle">
                                <div class="flex item-center justify-center gap-2">
                                    <a href="{{ route('visitor.read', $item->id) }}" target="_blank" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-blue-100 hover:text-blue-500 transition" title="Lihat di Web">
                                        👁️
                                    </a>
                                    
                                    <a href="#" onclick="alert('Fitur EDIT akan kita buat di langkah selanjutnya! 🛠️')" class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 hover:bg-yellow-200 transition" title="Edit">
                                        ✏️
                                    </a>

                                    <form action="{{ route('articles.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin mau menghapus karya ini selamanya?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-500 hover:bg-red-200 transition" title="Hapus">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-gray-400">
                                <div class="text-6xl mb-4">🎨</div>
                                <p class="text-lg">Belum ada karya yang dibuat.</p>
                                <p class="text-sm">Klik tombol "Buat Karya Baru" di atas untuk mulai berkarya!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html> 