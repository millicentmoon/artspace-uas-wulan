<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - ArtSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Nunito', sans-serif; background-color: #FFFBEB; } .font-ceria { font-family: 'Fredoka', sans-serif; }</style>
</head>
<body class="flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-md bg-white rounded-[2rem] shadow-2xl border-4 border-purple-300 overflow-hidden animate-[bounce_0.5s_ease-out]">
        <div class="bg-purple-100 p-6 text-center border-b-2 border-purple-200">
            <h1 class="text-3xl font-ceria text-purple-600">🚀 Gabung ArtSpace</h1>
            <p class="text-sm text-gray-500">Mulai petualangan senimu!</p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="p-8 space-y-4">
            @csrf

            <div>
                <label class="block text-gray-500 font-bold mb-1 text-sm">Nama Panggilan</label>
                <input type="text" name="name" class="w-full p-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-purple-400 focus:bg-white outline-none font-bold text-gray-700" placeholder="Contoh: Jagoan Neon" required>
            </div>

            <div>
                <label class="block text-gray-500 font-bold mb-1 text-sm">Email</label>
                <input type="email" name="email" class="w-full p-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-purple-400 focus:bg-white outline-none font-bold text-gray-700" placeholder="email@kamu.com" required>
            </div>

            <div>
                <label class="block text-gray-500 font-bold mb-1 text-sm">Kata Sandi</label>
                <input type="password" name="password" class="w-full p-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-purple-400 focus:bg-white outline-none font-bold text-gray-700" placeholder="Minimal 8 karakter" required>
            </div>

            <div>
                <label class="block text-gray-500 font-bold mb-1 text-sm">Ulangi Kata Sandi</label>
                <input type="password" name="password_confirmation" class="w-full p-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-purple-400 focus:bg-white outline-none font-bold text-gray-700" placeholder="Ketik ulang password tadi..." required>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-purple-400 to-pink-400 text-white font-bold shadow-lg hover:scale-105 transition transform mt-4">
                ✨ DAFTAR SEKARANG
            </button>
        </form>
        
        <div class="p-4 bg-gray-50 text-center text-sm text-gray-500 border-t border-gray-100">
            Sudah punya akun? <a href="/" class="text-purple-500 font-bold hover:underline">Masuk di sini</a>
        </div>
    </div>

</body>
</html>