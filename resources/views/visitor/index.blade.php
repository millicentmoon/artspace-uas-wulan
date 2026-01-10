<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Member - ArtSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #FFFBEB; color: #4B5563; }
        h1, h2, h3, .font-ceria { font-family: 'Fredoka', sans-serif; }
        #sidebar { transition: transform 0.3s ease-in-out; }
        .sidebar-open { transform: translateX(0); }
        .sidebar-closed { transform: translateX(-100%); }
        .shadow-pop { box-shadow: 6px 6px 0px 0px rgba(0,0,0,0.1); }
        .shadow-pop-pink { box-shadow: 8px 8px 0px 0px rgba(236, 72, 153, 0.3); }
        .shadow-pop-blue { box-shadow: 6px 6px 0px 0px rgba(59, 130, 246, 0.2); }
        .shadow-pop-yellow { box-shadow: 6px 6px 0px 0px rgba(251, 191, 36, 0.4); }
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

            <div class="mb-8 bg-blue-50 p-4 rounded-xl border-2 border-blue-200 shadow-sm">
                @auth
                <div class="flex items-center gap-3 mb-3 border-b-2 border-blue-100 pb-2">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" class="w-8 h-8 rounded-full border-2 border-white">
                    <div>
                        <p class="text-xs text-gray-400 font-bold uppercase">Halo, Member</p>
                        <h4 class="text-sm font-bold text-blue-600">{{ Auth::user()->name }}</h4>
                    </div>
                </div>
                
                <ul class="space-y-2 text-sm font-bold">
                    <li>
                        <a href="{{ route('visitor.home') }}" class="flex items-center text-white bg-blue-500 hover:bg-blue-600 p-2 rounded-lg transition shadow-pop-blue">
                            <span class="mr-3">🏠</span> Beranda
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex w-full items-center text-red-500 hover:bg-red-100 p-2 rounded-lg transition">
                                <span class="mr-3">🚪</span> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
                @else
                <div class="text-center">
                    <p class="text-sm text-gray-500 mb-2">Kamu belum login.</p>
                    <a href="{{ route('login') }}" class="block bg-pink-500 text-white py-2 rounded-lg font-bold">Masuk Sekarang</a>
                </div>
                @endauth
            </div>

            <div class="mb-8">
                <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Informasi</h4>
                <ul class="space-y-2 text-sm font-bold">
                    <li><a href="javascript:void(0)" onclick="toggleAbout()" class="flex items-center text-gray-600 hover:text-blue-500 hover:bg-blue-50 p-2 rounded-lg transition"><span class="mr-3">🏢</span> Tentang Kami</a></li>
                    <li><a href="javascript:void(0)" onclick="toggleContact()" class="flex items-center text-gray-600 hover:text-blue-500 hover:bg-blue-50 p-2 rounded-lg transition"><span class="mr-3">📞</span> Kontak</a></li>
                    <li><a href="javascript:void(0)" onclick="togglePrivacy()" class="flex items-center text-gray-600 hover:text-blue-500 hover:bg-blue-50 p-2 rounded-lg transition"><span class="mr-3">🔒</span> Kebijakan Privasi</a></li>
                </ul>
            </div>

            <hr class="border-dashed border-gray-300 mb-8">

            <div class="mb-8">
                <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Gerakan Seni</h4>
                <div class="grid grid-cols-1 gap-2">
                    <a href="{{ route('visitor.home', ['category' => 'Seni Kuno']) }}" class="bg-yellow-100 text-yellow-800 px-3 py-2 rounded-lg font-bold hover:bg-yellow-200 transition text-sm">🏺 Seni Kuno</a>
                    <a href="{{ route('visitor.home', ['category' => 'Seni Prasejarah']) }}" class="bg-orange-100 text-orange-800 px-3 py-2 rounded-lg font-bold hover:bg-orange-200 transition text-sm">🦖 Seni Prasejarah</a>
                    <a href="{{ route('visitor.home', ['category' => 'Abad Pertengahan']) }}" class="bg-purple-100 text-purple-800 px-3 py-2 rounded-lg font-bold hover:bg-purple-200 transition text-sm">🏰 Abad Pertengahan</a>
                    <a href="{{ route('visitor.home', ['category' => 'Modern']) }}" class="bg-blue-100 text-blue-800 px-3 py-2 rounded-lg font-bold hover:bg-blue-200 transition text-sm">🏙️ Seni Modern</a>
                </div>
            </div>

            <div>
                <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Bentuk Seni</h4>
                <ul class="space-y-2 font-bold text-sm text-gray-600">
                    <li><a href="{{ route('visitor.home', ['category' => 'Lukisan']) }}" class="block hover:text-pink-500 transition border-l-4 border-transparent hover:border-pink-500 pl-2">🎨 Lukisan</a></li>
                    <li><a href="{{ route('visitor.home', ['category' => 'Patung']) }}" class="block hover:text-pink-500 transition border-l-4 border-transparent hover:border-pink-500 pl-2">🗿 Patung</a></li>
                    <li><a href="{{ route('visitor.home', ['category' => 'Arsitektur']) }}" class="block hover:text-pink-500 transition border-l-4 border-transparent hover:border-pink-500 pl-2">🏛️ Arsitektur</a></li>
                    <li><a href="{{ route('visitor.home', ['category' => 'Fotografi']) }}" class="block hover:text-pink-500 transition border-l-4 border-transparent hover:border-pink-500 pl-2">📸 Fotografi</a></li>
                    <li><a href="{{ route('visitor.home', ['category' => 'Desain Digital']) }}" class="block hover:text-pink-500 transition border-l-4 border-transparent hover:border-pink-500 pl-2">💻 Desain Digital</a></li>
                </ul>
            </div>
        </div>
    </aside>

    <nav class="bg-white border-b-4 border-blue-300 py-4 sticky top-0 z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="bg-yellow-300 hover:bg-yellow-400 text-yellow-900 p-2 rounded-lg transition shadow-pop">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
                <form action="{{ route('visitor.home') }}" method="GET" class="hidden md:block">
                    <input type="text" name="search" value="{{ request('search') }}" class="bg-gray-100 border-2 border-gray-200 text-sm rounded-full px-4 py-2 w-64 focus:outline-none focus:border-pink-400" placeholder="Cari inspirasi...">
                </form>
            </div>
            
            @auth
            <div class="font-ceria font-bold text-xl text-gray-700">ArtSpace <span class="text-pink-500">Member</span></div>
            @else
            <a href="{{ route('login') }}" class="bg-pink-500 text-white px-4 py-2 rounded-full font-bold text-sm shadow-pop hover:shadow-none transition">Masuk</a>
            @endauth
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12 min-h-screen">
        
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-ceria text-gray-800 mb-2">
                @auth
                    Selamat Datang, <span class="text-pink-500 underline decoration-wavy decoration-blue-300">{{ Auth::user()->name }}!</span>
                @else
                    Selamat Datang di <span class="text-pink-500">ArtSpace!</span>
                @endauth
            </h1>
            <p class="text-gray-500">Selamat membaca dan menikmati karya seni.</p>
        </div>

        @if($featured)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12 items-start">
            
            <div class="lg:col-span-3 space-y-4">
                <h3 class="font-ceria text-lg text-blue-500 border-b-2 border-dashed border-blue-200 pb-2">🔥 Pilihan Editor</h3>
                @foreach($others->take(2) as $item)
                <a href="{{ route('visitor.read', $item->id) }}" class="block bg-white p-3 rounded-2xl shadow-sm hover:shadow-pop-pink border border-gray-100 transition group">
                    <div class="overflow-hidden h-32 rounded-xl mb-2 bg-gray-100">
                         @if($item->image) <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition">
                         @else <img src="https://picsum.photos/seed/{{ $item->id }}/400/300" class="w-full h-full object-cover group-hover:scale-110 transition"> @endif
                    </div>
                    <h4 class="font-bold text-sm text-gray-800 group-hover:text-pink-500 line-clamp-2">{{ $item->title }}</h4>
                </a>
                @endforeach
            </div>

            <div class="lg:col-span-6">
                <a href="{{ route('visitor.read', $featured->id) }}" class="block group relative bg-white p-4 rounded-[2rem] border-4 border-pink-200 shadow-pop-pink hover:border-pink-400 transition">
                    <div class="overflow-hidden h-[450px] rounded-[1.5rem] relative bg-gray-200">
                         @if($featured->image) <img src="{{ asset('storage/' . $featured->image) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                         @else <img src="https://picsum.photos/seed/{{ $featured->id }}/800/1000" class="w-full h-full object-cover transition duration-700 group-hover:scale-105"> @endif
                         
                         <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-8 text-white">
                             <span class="bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded mb-2 inline-block">BACA SEKARANG</span>
                             <h2 class="text-3xl font-ceria font-bold">{{ $featured->title }}</h2>
                         </div>
                    </div>
                </a>
            </div>

            <div class="lg:col-span-3 space-y-4">
                <h3 class="font-ceria text-lg text-yellow-500 border-b-2 border-dashed border-yellow-200 pb-2">🆕 Terbaru</h3>
                @foreach($others->skip(2)->take(2) as $item)
                <a href="{{ route('visitor.read', $item->id) }}" class="block bg-white p-3 rounded-2xl shadow-sm hover:shadow-pop-pink border border-gray-100 transition group">
                    <div class="overflow-hidden h-32 rounded-xl mb-2 bg-gray-100">
                         @if($item->image) <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition">
                         @else <img src="https://picsum.photos/seed/{{ $item->id }}/400/300" class="w-full h-full object-cover group-hover:scale-110 transition"> @endif
                    </div>
                    <h4 class="font-bold text-sm text-gray-800 group-hover:text-pink-500 line-clamp-2">{{ $item->title }}</h4>
                </a>
                @endforeach
            </div>
        </div>

        @if($others->count() > 4)
        <div class="border-t-4 border-dotted border-pink-200 pt-12 mt-12">
            <div class="flex items-center justify-center mb-8">
                <h3 class="font-ceria text-3xl text-gray-800 border-b-4 border-yellow-300 pb-1 inline-block">
                    📚 Koleksi Artikel Lainnya
                </h3>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($others->skip(4) as $item)
                <a href="{{ route('visitor.read', $item->id) }}" class="group cursor-pointer bg-white p-3 rounded-2xl shadow-sm hover:shadow-pop-blue border border-gray-100 transition duration-300">
                    <div class="overflow-hidden mb-3 h-32 rounded-xl bg-gray-100 relative">
                        @if($item->image) <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                        @else <img src="https://picsum.photos/seed/{{ $item->id }}/400/300" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500"> @endif
                    </div>
                    <span class="text-[10px] bg-gray-100 text-gray-600 px-2 py-1 rounded font-bold uppercase">Bacaan</span>
                    <h3 class="text-md font-ceria font-bold leading-tight text-gray-800 group-hover:text-pink-500 transition mt-2 line-clamp-2">
                        {{ $item->title }}
                    </h3>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        @else
        <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-300">
            <h3 class="text-xl font-bold text-gray-400">{{ $searchMessage ?? 'Belum ada artikel.' }}</h3>
        </div>
        @endif

    </main>

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
            if (sidebar.classList.contains('sidebar-closed')) {
                sidebar.classList.remove('sidebar-closed'); sidebar.classList.add('sidebar-open'); overlay.classList.remove('hidden');
            } else {
                sidebar.classList.remove('sidebar-open'); sidebar.classList.add('sidebar-closed'); overlay.classList.add('hidden');
            }
        }
        function toggleAbout() { document.getElementById('aboutModal').classList.toggle('hidden'); }
        function toggleContact() { document.getElementById('contactModal').classList.toggle('hidden'); }
        function togglePrivacy() { document.getElementById('privacyModal').classList.toggle('hidden'); }
    </script>
</body>
</html>