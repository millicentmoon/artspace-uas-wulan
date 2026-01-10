<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Artikel - ArtSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-10">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Artikel</h2>

        <form action="{{ route('articles.update', $article->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Judul Artikel</label>
                <input type="text" name="title" value="{{ $article->title }}" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Penulis</label>
                <input type="text" name="author" value="{{ $article->author }}" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tanggal Publikasi</label>
                <input type="date" name="published_date" value="{{ $article->published_date }}" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Isi Artikel</label>
                <textarea name="content" rows="6" class="w-full border rounded p-2" required>{{ $article->content }}</textarea>
            </div>
            <div class="flex justify-between">
                <a href="{{ route('dashboard') }}" class="text-gray-500 mt-2">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-bold">Update Artikel</button>
            </div>
        </form>
    </div>
</body>
</html>