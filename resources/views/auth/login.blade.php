<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - ArtSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Nunito', sans-serif; background-color: #FFFBEB; } .font-ceria { font-family: 'Fredoka', sans-serif; }</style>
</head>
<body class="flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-md bg-white rounded-[2rem] shadow-xl p-8 border-t-8 border-pink-400">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-ceria font-bold text-gray-800">Selamat Datang!</h2>
            <p class="text-gray-500 mt-2">Silakan masuk untuk melanjutkan.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 text-sm font-bold text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-600 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" class="w-full p-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-pink-400" required>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-600 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" class="w-full p-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-pink-400" required>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-orange-400 text-white font-bold py-3 rounded-xl hover:shadow-lg transition transform hover:-translate-y-1">
                MASUK SEKARANG
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="/" class="text-gray-400 hover:text-pink-500 text-sm font-bold">← Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>