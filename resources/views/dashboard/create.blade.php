<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Artikel - ArtSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-10">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Tulis Artikel Baru</h2>

        <form action="{{ route('articles.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Judul Artikel</label>
                <input type="text" name="title" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Penulis</label>
                <input type="text" name="author" class="w-full border rounded p-2" value="Admin Galeri" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tanggal Publikasi</label>
                <input type="date" name="published_date" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Isi Artikel</label>
                <textarea name="content" rows="6" class="w-full border rounded p-2" required></textarea>
            </div>
            <div class="flex justify-between">
                <a href="{{ route('dashboard') }}" class="text-gray-500 mt-2">Batal</a>
                <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded hover:bg-amber-700 font-bold">Simpan Artikel</button>
            </div>
        </form>
    </div>
</body>
</html>
