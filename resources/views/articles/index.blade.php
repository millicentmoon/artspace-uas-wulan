<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Artikel - ArtSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Nunito', sans-serif; background-color: #FFFBEB; } .font-ceria { font-family: 'Fredoka', sans-serif; }</style>
</head>
<body class="p-6">

    <div class="max-w-7xl mx-auto">
        
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-ceria font-bold text-gray-800">⚙️ Kelola Artikel</h1>
                <p class="text-gray-500">Manajemen semua karya seni di database.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('dashboard') }}" class="bg-gray-200 text-gray-600 px-4 py-2 rounded-lg font-bold hover:bg-gray-300 transition">
                    ← Kembali ke Dashboard
                </a>
                <a href="{{ route('articles.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-600 transition shadow-lg">
                    ➕ Tambah Artikel
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-2 border-blue-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-blue-50 text-blue-800 uppercase text-xs font-bold">
                            <th class="p-4 border-b border-blue-100">Gambar</th>
                            <th class="p-4 border-b border-blue-100">Judul & Cuplikan</th>
                            <th class="p-4 border-b border-blue-100">Kategori</th>
                            <th class="p-4 border-b border-blue-100">Penulis</th>
                            <th class="p-4 border-b border-blue-100 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        @forelse($articles as $item)
                        <tr class="hover:bg-yellow-50 transition border-b border-gray-100 last:border-0">
                            <td class="p-4 w-24">
                                <div class="w-16 h-16 rounded-lg overflow-hidden border border-gray-200 bg-gray-100">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300 text-xs">No Img</div>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="block font-bold text-gray-800 text-base mb-1">{{ $item->title }}</span>
                                <span class="block text-xs text-gray-400 truncate max-w-xs">{{ \Illuminate\Support\Str::limit($item->content, 50) }}</span>
                            </td>
                            <td class="p-4">
                                <span class="bg-purple-100 text-purple-600 py-1 px-3 rounded-full text-xs font-bold">
                                    {{ $item->movement }}
                                </span>
                                <span class="bg-green-100 text-green-600 py-1 px-3 rounded-full text-xs font-bold ml-1">
                                    {{ $item->type }}
                                </span>
                            </td>
                            <td class="p-4 font-bold text-gray-500">
                                {{ $item->author }}
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('articles.edit', $item->id) }}" class="bg-yellow-100 text-yellow-600 p-2 rounded-lg hover:bg-yellow-200 transition" title="Edit">
                                        ✏️
                                    </a>
                                    <form action="{{ route('articles.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini permanen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-100 text-red-600 p-2 rounded-lg hover:bg-red-200 transition" title="Hapus">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-400">
                                Belum ada artikel. Klik tombol <strong>Tambah Artikel</strong> di atas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-t border-gray-100">
                {{ $articles->links() }}
            </div>
        </div>

    </div>

</body>
</html>