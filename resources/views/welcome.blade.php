<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtSpace - Ceria & Penuh Warna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #FFFBEB; color: #4B5563; }
        h1, h2, h3, .font-ceria { font-family: 'Fredoka', sans-serif; }
        
        /* Sidebar Animasi */
        #sidebar { transition: transform 0.3s ease-in-out; }
        .sidebar-open { transform: translateX(0); }
        .sidebar-closed { transform: translateX(-100%); }

        /* Efek Bayangan Pop Art */
        .shadow-pop { box-shadow: 6px 6px 0px 0px rgba(0,0,0,0.1); }
        .shadow-pop-pink { box-shadow: 8px 8px 0px 0px rgba(236, 72, 153, 0.3); }
        .shadow-pop-blue { box-shadow: 6px 6px 0px 0px rgba(59, 130, 246, 0.2); }
    </style>
</head>
<body class="overflow-x-hidden">

    <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-yellow-900 bg-opacity-20 z-40 hidden transition-opacity backdrop-blur-sm"></div>
    
    <aside id="sidebar" class="fixed top-0 left-0 w-80 h-full bg-white z-50 shadow-2xl sidebar-closed overflow-y-auto border-r-4 border-pink-400">
        <div class="p-6">
            
            <div class="flex justify-between items-center mb-8">
                <span class="text-2xl font-ceria font-bold text-pink-500">Menu Art<span class="text-blue-500">Space</span></span>
                <button onclick="toggleSidebar()" class="bg-red-100 text-red-500 hover:bg-red-200 rounded-full p-2 font-bold">&times;</button>
            </div>

            <div class="mb-8">
                <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Informasi</h4>
                <ul class="space-y-2 text-sm font-bold">
                    <li>
                        <a href="javascript:void(0)" onclick="toggleAbout()" class="flex items-center text-gray-600 hover:text-blue-500 hover:bg-blue-50 p-2 rounded-lg transition">
                            <span class="mr-3">🏢</span> Tentang Kami
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" onclick="toggleContact()" class="flex items-center text-gray-600 hover:text-blue-500 hover:bg-blue-50 p-2 rounded-lg transition">
                            <span class="mr-3">📞</span> Kontak
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" onclick="togglePrivacy()" class="flex items-center text-gray-600 hover:text-blue-500 hover:bg-blue-50 p-2 rounded-lg transition">
                            <span class="mr-3">🔒</span> Kebijakan Privasi
                        </a>
                    </li>
                </ul>
            </div>
            
        </div>
    </aside>

    <nav class="bg-white border-b-4 border-blue-300 py-4 sticky top-0 z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="bg-yellow-300 hover:bg-yellow-400 text-yellow-900 p-2 rounded-lg transition shadow-pop">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                
                <form action="{{ route('home') }}" method="GET" class="hidden md:block">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="bg-gray-100 border-2 border-gray-200 text-sm text-gray-700 rounded-full px-4 py-2 w-64 focus:outline-none focus:border-pink-400 focus:bg-white transition"
                           placeholder="Cari lukisan seru...">
                </form>
            </div>

            <div class="absolute left-1/2 transform -translate-x-1/2">
                <a href="{{ route('home') }}" class="text-3xl font-ceria font-bold text-gray-800 tracking-wide flex items-center gap-2">
                    <span class="bg-pink-500 text-white rounded-lg px-2 transform -rotate-3">Art</span>
                    <span class="text-blue-500">Space</span>
                </a>
            </div>

            @auth
                <div class="flex items-center gap-3">
                    <span class="text-sm font-bold text-gray-600 hidden md:inline">Halo, {{ Auth::user()->name }}!</span>
                    <a href="{{ route('dashboard') }}" class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full font-bold hover:bg-blue-200 transition text-sm">
                        Dashboard
                    </a>
                </div>
            @else
                <div class="flex items-center gap-3">
                    <button onclick="toggleLogin()" class="bg-gradient-to-r from-pink-400 to-orange-400 text-white px-5 py-2 rounded-full text-sm font-bold shadow-pop hover:scale-105 transition">
                        Masuk
                    </button>
                </div>
            @endauth
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12 min-h-screen">
        
        <div class="text-center mb-12 relative">
            <span class="bg-yellow-300 text-yellow-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-4 inline-block transform rotate-2 shadow-sm">
                ✨ Cerita Pilihan Hari Ini
            </span>
            <h1 class="text-5xl md:text-6xl font-ceria text-gray-800 mb-2">
                Art to <span class="text-pink-500 underline decoration-wavy decoration-blue-300">Warm</span> You Up
            </h1>
            <p class="text-gray-500 mt-4 max-w-lg mx-auto">Kumpulan karya seni penuh warna untuk mencerahkan harimu.</p>
        </div>

        @if(isset($singlePost) && $singlePost)
            <div class="max-w-4xl mx-auto animate-fade-in-up">
                <div class="bg-white p-8 rounded-[2rem] border-4 border-blue-200 shadow-pop-pink relative">
                    <span class="absolute top-0 left-0 bg-yellow-300 text-yellow-900 px-4 py-1 rounded-br-xl rounded-tl-xl font-bold font-ceria">✨ Hasil Pencarian</span>
                    
                    <h2 class="text-4xl font-ceria font-bold text-gray-800 mb-4 mt-8">{{ $singlePost->title }}</h2>
                    <div class="overflow-hidden rounded-xl h-96 mb-6 border-2 border-gray-100 shadow-inner bg-gray-100">
                        @if($singlePost->image)
                            <img src="{{ asset('storage/' . $singlePost->image) }}" class="w-full h-full object-cover">
                        @else
                            <img src="https://picsum.photos/seed/{{ $singlePost->id }}/800/400" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <article class="prose lg:prose-xl text-gray-600">
                        {{ $singlePost->content }}
                    </article>
                    <div class="mt-8 text-center">
                        <a href="{{ route('home') }}" class="inline-block bg-gray-100 text-gray-500 px-6 py-2 rounded-full font-bold hover:bg-pink-100 hover:text-pink-500 transition">← Kembali ke Beranda</a>
                    </div>
                </div>
            </div>

        @elseif(isset($searchMessage))
            <div class="text-center py-10 mb-10">
                <div class="text-6xl mb-4">🙈</div>
                <h2 class="text-2xl font-bold text-red-400 font-ceria">{{ $searchMessage }}</h2>
                <p class="text-gray-400 mt-2">Tapi tenang, coba cek rekomendasi keren ini:</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($recommendations as $item)
                <div class="bg-white p-4 rounded-2xl shadow-sm hover:shadow-pop-blue border border-gray-100 transition group cursor-pointer">
                    <div class="h-48 overflow-hidden rounded-xl mb-4 relative bg-gray-100">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <img src="https://picsum.photos/seed/{{ $item->id }}/400/300" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @endif
                    </div>
                    <h3 class="font-ceria font-bold text-lg text-gray-800 group-hover:text-pink-500">{{ $item->title }}</h3>
                    <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ $item->content }}</p>
                </div>
                @endforeach
            </div>
            <div class="mt-8 text-center">
                <a href="{{ route('home') }}" class="text-blue-500 font-bold hover:underline">Lihat Semua Karya</a>
            </div>

        @else
            @if($featured)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-20 items-start">
                
                <div class="lg:col-span-3 space-y-6">
                    <h3 class="font-ceria text-xl text-blue-500 border-b-2 border-dashed border-blue-200 pb-2 mb-4">🔥 Lagi Trending</h3>
                    @foreach($others->take(2) as $item)
                    <div class="group cursor-pointer bg-white p-3 rounded-2xl shadow-sm hover:shadow-pop-blue border border-gray-100 transition duration-300">
                        <div class="overflow-hidden mb-3 h-32 rounded-xl bg-gray-100">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                            @else
                                <img src="https://picsum.photos/seed/{{ $item->id }}/400/300" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                            @endif
                        </div>
                        <span class="text-[10px] bg-blue-100 text-blue-600 px-2 py-1 rounded font-bold uppercase">Lukisan</span>
                        <h3 class="text-md font-ceria font-bold leading-tight text-gray-800 group-hover:text-pink-500 transition mt-2">{{ $item->title }}</h3>
                    </div>
                    @endforeach
                </div>

                <div class="lg:col-span-6">
                    <div class="group cursor-pointer relative bg-white p-4 rounded-[2rem] border-4 border-pink-200 shadow-pop-pink hover:border-pink-400 transition duration-300">
                        <div class="overflow-hidden h-[450px] rounded-[1.5rem] relative bg-gray-200">
                            @if($featured->image)
                                <img src="{{ asset('storage/' . $featured->image) }}" class="w-full h-full object-cover transition duration-700 transform group-hover:scale-105">
                            @else
                                <img src="https://picsum.photos/seed/{{ $featured->id }}/800/1000" class="w-full h-full object-cover transition duration-700 transform group-hover:scale-105">
                            @endif
                            
                            <div class="absolute top-4 right-4 bg-white text-gray-800 text-center p-3 rounded-xl shadow-lg border-2 border-yellow-300 transform rotate-3">
                                <span class="block text-xs font-bold text-gray-400 uppercase">Tgl</span>
                                <span class="block text-xl font-ceria font-bold text-pink-500">{{ \Carbon\Carbon::parse($featured->published_date)->format('d') }}</span>
                            </div>
                        </div>

                        <div class="mt-6 text-center px-4 pb-4">
                            <span class="bg-pink-100 text-pink-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest">
                                🌟 Sorotan Utama
                            </span>
                            <h2 class="text-4xl font-ceria text-gray-900 mt-4 mb-3 group-hover:text-blue-500 transition leading-tight">
                                {{ $featured->title }}
                            </h2>
                            <p class="text-gray-500 leading-relaxed mb-6 line-clamp-3">
                                {{ $featured->content }}
                            </p>
                            
                            <div class="flex justify-center items-center gap-2">
                                <div class="h-8 w-8 bg-gray-200 rounded-full overflow-hidden">
                                    <img src="https://ui-avatars.com/api/?name={{ $featured->author }}&background=random" alt="Avatar">
                                </div>
                                <span class="text-sm font-bold text-gray-600">
                                    Oleh {{ $featured->author }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-3 space-y-6">
                    <h3 class="font-ceria text-xl text-yellow-500 border-b-2 border-dashed border-yellow-200 pb-2 mb-4">🆕 Baru Rilis</h3>
                    @foreach($others->skip(2)->take(2) as $item)
                    <div class="group cursor-pointer bg-white p-3 rounded-2xl shadow-sm hover:shadow-pop-blue border border-gray-100 transition duration-300">
                        <div class="overflow-hidden mb-3 h-32 rounded-xl bg-gray-100">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                            @else
                                <img src="https://picsum.photos/seed/{{ $item->id }}/400/300" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                            @endif
                        </div>
                        <span class="text-[10px] bg-yellow-100 text-yellow-700 px-2 py-1 rounded font-bold uppercase">Info Seni</span>
                        <h3 class="text-md font-ceria font-bold leading-tight text-gray-800 group-hover:text-pink-500 transition mt-2">{{ $item->title }}</h3>
                    </div>
                    @endforeach
                </div>

            </div>
            @else
            <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-300">
                <div class="text-6xl mb-4">🎨</div>
                <h3 class="text-xl font-bold text-gray-400">Belum ada lukisan yang dipajang.</h3>
            </div>
            @endif

            @if($others->count() > 4)
            <div class="border-t-4 border-dotted border-pink-200 pt-12 mt-12">
                <h3 class="text-3xl font-ceria text-gray-800 mb-8 text-center">Masih Banyak Lagi! 👇</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    @foreach($others->skip(4) as $item)
                    <div class="bg-white p-4 rounded-2xl shadow-sm hover:shadow-md transition border border-gray-100 flex flex-col items-center text-center">
                        <div class="w-24 h-24 mb-4 rounded-full border-4 border-blue-100 overflow-hidden bg-gray-100">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover">
                            @else
                                <img src="https://picsum.photos/seed/{{ $item->id }}/200/200" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <h4 class="font-ceria font-bold text-lg text-gray-800 hover:text-pink-500 transition">{{ $item->title }}</h4>
                        <p class="text-xs text-gray-400 mt-2">{{ $item->published_date }}</p>
                        <a href="#" class="text-xs font-bold text-blue-500 mt-3 hover:underline">Baca Aja &rarr;</a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        @endif
    </main>

    <footer class="bg-white border-t-4 border-yellow-400 py-12 mt-12 text-center">
        <p class="font-ceria text-gray-500 text-sm">
            Dibuat dengan 🎨 Warna-Warni di <span class="text-pink-500 font-bold">ArtSpace</span>
        </p>
    </footer>

    <div id="loginModal" class="fixed inset-0 z-[100] hidden items-center justify-center">
        <div onclick="toggleLogin()" class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity cursor-pointer"></div>
        <div class="relative w-full max-w-md bg-white rounded-[2rem] shadow-2xl p-8 transform transition-all scale-100 border-t-8 border-pink-400 animate-[bounce_0.5s_ease-out] m-4">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-ceria font-bold text-gray-800">Masuk ArtSpace</h2>
                <p class="text-sm text-gray-500 mt-2">Mulai berkarya hari ini!</p>
            </div>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input type="email" name="email" placeholder="Email Kamu" class="w-full p-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-pink-400 focus:bg-white transition font-bold text-gray-600 placeholder-gray-300" required>
                </div>
                <div class="mb-6">
                    <input type="password" name="password" placeholder="Kata Sandi Rahasia" class="w-full p-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-pink-400 focus:bg-white transition font-bold text-gray-600 placeholder-gray-300" required>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-orange-400 text-white font-bold py-3 rounded-xl shadow-pop hover:shadow-none hover:translate-y-1 transition duration-200">
                    MASUK
                </button>
            </form>
            <div class="mt-6 text-center border-t border-gray-100 pt-4">
                <p class="text-sm text-gray-400 mb-2">Belum punya akun?</p>
                <a href="{{ route('register') }}" class="inline-block bg-purple-100 text-purple-600 px-4 py-2 rounded-lg font-bold hover:bg-purple-200 transition text-sm">
                    ✨ Daftar Akun Baru
                </a>
            </div>
            <div class="mt-4 text-center">
                <button onclick="toggleLogin()" class="text-xs font-bold text-gray-400 hover:text-pink-500 underline">Tutup</button>
            </div>
        </div>
    </div>

    <div id="aboutModal" class="fixed inset-0 z-[110] hidden">
        <div onclick="toggleAbout()" class="absolute inset-0 bg-yellow-900/40 backdrop-blur-md transition-opacity cursor-pointer"></div>
        <div class="relative m-auto mt-10 w-full max-w-2xl bg-white rounded-[2rem] shadow-2xl overflow-hidden transform transition-all scale-100 border-4 border-blue-300 animate-[bounce_0.3s_ease-out]">
            <div class="bg-gradient-to-r from-blue-400 to-purple-400 p-6 text-center relative overflow-hidden">
                <div class="absolute top-[-50px] left-[-50px] w-32 h-32 bg-white opacity-20 rounded-full"></div>
                <div class="absolute bottom-[-20px] right-[-20px] w-24 h-24 bg-yellow-300 opacity-30 rounded-full"></div>
                <h2 class="text-3xl font-ceria text-white relative z-10">🎨 Tentang ArtSpace</h2>
                <p class="text-blue-50 font-bold relative z-10">Making Life More Colorful!</p>
                <button onclick="toggleAbout()" class="absolute top-4 right-4 bg-white/20 hover:bg-white/40 text-white rounded-full p-2 transition"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>
            <div class="p-8 space-y-6 text-gray-600">
                <div class="flex gap-4 items-start"><div class="text-4xl">👋</div><div><h3 class="text-xl font-bold text-gray-800 font-ceria">Hai, Pecinta Seni!</h3><p class="mt-2 leading-relaxed">Selamat datang di <strong>ArtSpace</strong>. Kami percaya seni itu bukan cuma buat museum yang sepi, tapi buat kita semua! Di sini, kita ngobrolin lukisan, patung, dan warna-warni dunia dengan cara yang asik.</p></div></div>
                <div class="bg-yellow-50 p-4 rounded-xl border-l-4 border-yellow-400"><h4 class="font-bold text-yellow-800 mb-1">🚀 Misi Kami</h4><p class="text-sm text-gray-600">Menghapus "kebosanan" dari sejarah seni dan memberikan inspirasi visual setiap hari untukmu.</p></div>
                <div><h3 class="text-lg font-bold text-gray-800 font-ceria mb-3">Tim Kreatif</h3><div class="flex items-center gap-4"><div class="flex -space-x-4"><img class="w-10 h-10 rounded-full border-2 border-white" src="https://ui-avatars.com/api/?name=Admin&background=FF512F&color=fff"><img class="w-10 h-10 rounded-full border-2 border-white" src="https://ui-avatars.com/api/?name=Writer&background=DD2476&color=fff"><img class="w-10 h-10 rounded-full border-2 border-white" src="https://ui-avatars.com/api/?name=Artist&background=4CA1AF&color=fff"></div><span class="text-sm text-gray-500 font-bold">+ Kamu (Calon Member)!</span></div></div>
            </div>
            <div class="p-6 bg-gray-50 border-t border-gray-100 text-center"><p class="text-sm text-gray-400 mb-3">Punya pertanyaan? Hubungi kami di <span class="text-blue-500 font-bold">hello@artspace.id</span></p><button onclick="toggleAbout()" class="bg-gray-200 text-gray-600 hover:bg-gray-300 px-6 py-2 rounded-full font-bold transition">Tutup</button></div>
        </div>
    </div>

    <div id="contactModal" class="fixed inset-0 z-[120] hidden">
        <div onclick="toggleContact()" class="absolute inset-0 bg-green-900/30 backdrop-blur-md transition-opacity cursor-pointer"></div>
        <div class="relative m-auto mt-10 w-full max-w-lg bg-white rounded-[2rem] shadow-2xl overflow-hidden transform transition-all scale-100 border-4 border-green-400 animate-[bounce_0.3s_ease-out]">
            <div class="bg-gradient-to-r from-green-400 to-teal-400 p-6 text-center relative"><h2 class="text-3xl font-ceria text-white relative z-10">📞 Ngobrol Yuk!</h2><p class="text-green-50 font-bold relative z-10">Kami siap dengerin curhat senimu.</p><button onclick="toggleContact()" class="absolute top-4 right-4 bg-white/20 hover:bg-white/40 text-white rounded-full p-2 transition"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button></div>
            <div class="p-8"><div class="grid grid-cols-2 gap-4 mb-6"><a href="#" class="flex flex-col items-center justify-center bg-green-50 p-4 rounded-2xl border-2 border-green-200 hover:bg-green-100 hover:scale-105 transition cursor-pointer"><span class="text-3xl mb-2">💬</span><span class="font-bold text-green-700 text-sm">WhatsApp</span></a><a href="#" class="flex flex-col items-center justify-center bg-blue-50 p-4 rounded-2xl border-2 border-blue-200 hover:bg-blue-100 hover:scale-105 transition cursor-pointer"><span class="text-3xl mb-2">📧</span><span class="font-bold text-blue-700 text-sm">Email Kami</span></a></div><form action="#" onsubmit="alert('Pesan terkirim! (Simulasi)'); return false;"><div class="mb-4"><label class="block text-gray-500 text-xs font-bold mb-1 uppercase">Nama Kamu</label><input type="text" class="w-full p-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-green-400 focus:bg-white transition font-bold text-gray-600" placeholder="Siapa nih?"></div><div class="mb-6"><label class="block text-gray-500 text-xs font-bold mb-1 uppercase">Pesan / Masukan</label><textarea class="w-full p-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-green-400 focus:bg-white transition font-bold text-gray-600 h-24" placeholder="Tulis sesuatu yang asik..."></textarea></div><button type="submit" class="w-full bg-gradient-to-r from-green-500 to-teal-500 text-white font-bold py-3 rounded-xl shadow-pop hover:shadow-none hover:translate-y-1 transition duration-200">KIRIM PESAN 🚀</button></form></div>
        </div>
    </div>

    <div id="privacyModal" class="fixed inset-0 z-[130] hidden">
        <div onclick="togglePrivacy()" class="absolute inset-0 bg-purple-900/40 backdrop-blur-md transition-opacity cursor-pointer"></div>
        <div class="relative m-auto mt-10 w-full max-w-2xl bg-white rounded-[2rem] shadow-2xl overflow-hidden transform transition-all scale-100 border-4 border-purple-400 animate-[bounce_0.3s_ease-out]">
            <div class="bg-gradient-to-r from-purple-500 to-indigo-500 p-6 text-center relative"><h2 class="text-3xl font-ceria text-white relative z-10">🔒 Rahasia Kamu Aman</h2><p class="text-purple-100 font-bold relative z-10">Janji suci ArtSpace untuk data kamu.</p><button onclick="togglePrivacy()" class="absolute top-4 right-4 bg-white/20 hover:bg-white/40 text-white rounded-full p-2 transition"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button></div>
            <div class="p-8 max-h-[60vh] overflow-y-auto"><div class="space-y-6 text-gray-600 leading-relaxed"><div class="bg-purple-50 p-4 rounded-xl border-l-4 border-purple-400"><p class="font-bold text-purple-800">Intinya Sih...</p><p class="text-sm">Kami gak bakal jual data kamu ke alien, agen rahasia, atau telemarketer. Data kamu cuma buat login doang.</p></div><div><h3 class="font-bold text-gray-800 text-lg mb-2">1. Data Apa yang Kami Ambil?</h3><ul class="list-disc list-inside text-sm mt-2 ml-2 space-y-1"><li>Nama (Biar kita bisa nyapa).</li><li>Email (Buat login).</li></ul></div><div class="pt-4 border-t border-gray-100 text-center"><p class="text-xs text-gray-400 italic">Terakhir diperbarui: Saat kamu baca ini.</p></div></div></div><div class="p-4 bg-gray-50 border-t border-gray-100 text-center"><button onclick="togglePrivacy()" class="bg-purple-500 text-white hover:bg-purple-600 px-8 py-2 rounded-full font-bold shadow-pop hover:shadow-none transition">Oke, Saya Paham 👌</button></div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const body = document.body;

            if (sidebar.classList.contains('sidebar-closed')) {
                sidebar.classList.remove('sidebar-closed');
                sidebar.classList.add('sidebar-open');
                overlay.classList.remove('hidden');
                body.style.overflow = 'hidden';
            } else {
                sidebar.classList.remove('sidebar-open');
                sidebar.classList.add('sidebar-closed');
                overlay.classList.add('hidden');
                body.style.overflow = 'auto';
            }
        }

        function toggleLogin() {
            const modal = document.getElementById('loginModal');
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        function toggleAbout() {
            const modal = document.getElementById('aboutModal');
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                const sidebar = document.getElementById('sidebar');
                if (sidebar.classList.contains('sidebar-open')) {
                    toggleSidebar(); 
                }
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        function toggleContact() {
            const modal = document.getElementById('contactModal');
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                const sidebar = document.getElementById('sidebar');
                if (sidebar.classList.contains('sidebar-open')) {
                    toggleSidebar(); 
                }
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        function togglePrivacy() {
            const modal = document.getElementById('privacyModal');
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                const sidebar = document.getElementById('sidebar');
                if (sidebar.classList.contains('sidebar-open')) {
                    toggleSidebar(); 
                }
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }
    </script>

</body>
</html>