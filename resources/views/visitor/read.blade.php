<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} - ArtSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #FFFBEB; color: #4B5563; }
        h1, h2, h3, .font-ceria { font-family: 'Fredoka', sans-serif; }
        .shadow-pop { box-shadow: 6px 6px 0px 0px rgba(0,0,0,0.1); }
        .shadow-pop-pink { box-shadow: 8px 8px 0px 0px rgba(236, 72, 153, 0.3); }
    </style>
</head>
<body class="overflow-x-hidden">

    <nav class="bg-white border-b-4 border-blue-300 py-4 sticky top-0 z-30 shadow-sm">
        <div class="max-w-4xl mx-auto px-6 flex justify-between items-center">
            <a href="{{ route('visitor.home') }}" class="flex items-center gap-2 text-gray-500 hover:text-pink-500 font-bold transition">
                <span class="bg-gray-100 p-2 rounded-full hover:bg-pink-100">⬅️</span>
                <span class="hidden md:inline">Kembali</span>
            </a>
            <div class="font-ceria font-bold text-xl text-gray-700">ArtSpace <span class="text-pink-500">Reader</span></div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-10">
        
        <div class="text-center mb-8">
            <span class="bg-yellow-300 text-yellow-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-4 inline-block">
                {{ $article->category ?? 'Artikel Seni' }}
            </span>
            <h1 class="text-4xl md:text-5xl font-ceria text-gray-800 leading-tight mb-4">
                {{ $article->title }}
            </h1>
            <div class="flex justify-center items-center gap-4 text-sm text-gray-500 font-bold">
                <span class="flex items-center gap-1">🗓️ {{ $article->created_at->format('d M Y') }}</span>
                <span class="flex items-center gap-1">✍️ {{ $article->author ?? 'Admin' }}</span>
            </div>
        </div>

        <div class="bg-white p-3 rounded-[2rem] border-4 border-pink-200 shadow-pop-pink mb-10 rotate-1 hover:rotate-0 transition duration-500">
            <div class="overflow-hidden rounded-[1.5rem] h-[300px] md:h-[500px]">
                @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-full object-cover">
                @else
                    <img src="https://picsum.photos/seed/{{ $article->id }}/1200/600" class="w-full h-full object-cover">
                @endif
            </div>
        </div>

        <div class="bg-white p-8 md:p-12 rounded-[2rem] shadow-sm border border-gray-100">
            <article class="prose prose-lg prose-pink max-w-none text-gray-600 leading-loose">
                {!! nl2br(e($article->content)) !!}
            </article>
            
            <hr class="my-8 border-dashed border-gray-300">

            <div class="text-center">
                <p class="font-ceria text-xl text-gray-800 mb-4">Suka artikel ini?</p>
                <div class="flex justify-center gap-4">
                    <button class="bg-pink-100 text-pink-500 px-6 py-2 rounded-full font-bold hover:bg-pink-200 transition">❤️ Suka</button>
                    <button class="bg-blue-100 text-blue-500 px-6 py-2 rounded-full font-bold hover:bg-blue-200 transition">🚀 Bagikan</button>
                </div>
            </div>
        </div>

        <div class="mt-16">
            <h3 class="font-ceria text-2xl text-gray-800 border-b-4 border-yellow-300 pb-1 inline-block mb-8">
                👀 Baca Juga Ini
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($related as $item)
                <a href="{{ route('visitor.read', $item->id) }}" class="group bg-white p-4 rounded-2xl shadow-sm hover:shadow-pop border border-gray-100 transition">
                    <div class="h-40 rounded-xl overflow-hidden mb-3">
                         @if($item->image) <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition">
                         @else <img src="https://picsum.photos/seed/{{ $item->id }}/400/300" class="w-full h-full object-cover group-hover:scale-110 transition"> @endif
                    </div>
                    <h4 class="font-bold text-gray-800 group-hover:text-pink-500 line-clamp-2">{{ $item->title }}</h4>
                </a>
                @endforeach
            </div>
        </div>

    </main>

    <footer class="text-center py-8 text-gray-400 text-sm font-bold">
        &copy; ArtSpace Reader 2024
    </footer>

</body>
</html>