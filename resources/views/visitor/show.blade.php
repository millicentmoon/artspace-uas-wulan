<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} - ArtSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Nunito', sans-serif; background-color: #FFFBEB; } .font-ceria { font-family: 'Fredoka', sans-serif; }</style>
</head>
<body class="min-h-screen">

    <nav class="bg-white border-b-4 border-pink-300 py-4 sticky top-0 z-30 shadow-sm">
        <div class="max-w-4xl mx-auto px-6 flex justify-between items-center">
            <a href="{{ route('visitor.home') }}" class="flex items-center text-gray-500 hover:text-pink-500 font-bold transition">
                ← Kembali ke Dashboard
            </a>
            <div class="font-ceria font-bold text-xl text-gray-700">ArtSpace <span class="text-pink-500">Read</span></div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-12">
        
        <div class="text-center mb-8">
            <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest">{{ $article->type }}</span>
            <h1 class="text-4xl md:text-5xl font-ceria text-gray-900 mt-4 mb-4 leading-tight">{{ $article->title }}</h1>
            <div class="flex justify-center items-center gap-2 text-gray-500 text-sm">
                <span>Ditulis oleh <strong>{{ $article->author }}</strong></span> • 
                <span>{{ \Carbon\Carbon::parse($article->published_date)->format('d M Y') }}</span>
            </div>
        </div>

        <div class="w-full h-[400px] md:h-[500px] rounded-[2rem] overflow-hidden shadow-2xl border-4 border-white mb-10">
             @if($article->image) <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-full object-cover">
             @else <img src="https://picsum.photos/seed/{{ $article->id }}/1200/600" class="w-full h-full object-cover"> @endif
        </div>

        <article class="prose prose-lg prose-pink mx-auto bg-white p-8 md:p-12 rounded-[2rem] shadow-sm border border-gray-100 text-gray-600 leading-relaxed">
            {!! nl2br(e($article->content)) !!}
        </article>

        <div class="mt-16 pt-10 border-t-4 border-dashed border-gray-300">
            <h3 class="text-2xl font-ceria text-gray-800 mb-6 text-center">Baca Juga Yuk! 👇</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($recommendations as $rec)
                <a href="{{ route('articles.show', $rec->id) }}" class="block bg-white p-4 rounded-2xl shadow-sm hover:shadow-lg transition border border-gray-100 group">
                    <div class="h-40 rounded-xl overflow-hidden mb-3 bg-gray-100">
                        @if($rec->image) <img src="{{ asset('storage/' . $rec->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition">
                        @else <img src="https://picsum.photos/seed/{{ $rec->id }}/400/300" class="w-full h-full object-cover"> @endif
                    </div>
                    <h4 class="font-bold text-gray-800 group-hover:text-pink-500 line-clamp-2">{{ $rec->title }}</h4>
                </a>
                @endforeach
            </div>
        </div>

    </main>

    <footer class="bg-white border-t-4 border-yellow-400 py-8 mt-12 text-center text-gray-500 text-sm">
        &copy; ArtSpace Member Area
    </footer>

</body>
</html>