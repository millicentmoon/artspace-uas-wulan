# 🎨 ArtSpace - Platform Edukasi & Galeri Seni

**ArtSpace** adalah aplikasi web berbasis **Laravel 12** yang berfungsi sebagai galeri digital dan platform edukasi seni. Aplikasi ini memungkinkan pengguna menjelajahi berbagai gerakan seni (Kuno, Prasejarah, Modern) dan admin untuk mengelola konten artikel.

---

## ✨ Fitur Utama

### 1. 🔐 Autentikasi & Otorisasi (Multi-Role)
* **Login & Register:** Sistem keamanan bawaan untuk pendaftaran akun baru.
* **Role Admin:** Memiliki akses penuh untuk **CRUD** (Membuat, Mengedit, Menghapus) artikel.
* **Role Member:** Akses terbatas hanya untuk membaca artikel (Read-only).

### 2. 📝 Manajemen Artikel (CRUD)
* Admin dapat mengelola artikel seni dengan atribut lengkap: Judul, Konten, Kategori (Gerakan Seni), Tipe Karya, dan Gambar Upload.
* Tampilan tabel manajemen data yang rapi khusus untuk Admin.

### 3. 🖼️ Antarmuka Modern (UI/UX)
* **Responsive Design:** Tampilan menyesuaikan layar HP, Tablet, dan Laptop.
* **Tailwind CSS:** Menggunakan framework CSS modern untuk styling yang estetik dan cepat.
* **Dashboard Interaktif:** Sidebar dinamis yang berubah menu-nya tergantung siapa yang login (Admin/Member).

### 4. 📂 Kategori Seni
* Pengelompokan artikel berdasarkan era: *Seni Kuno, Prasejarah, Abad Pertengahan, Modern*.
* Pengelompokan berdasarkan tipe: *Lukisan, Patung, Arsitektur, dll*.

---

## 🛠️ Teknologi yang Digunakan

* **Backend:** Laravel Framework 12.x
* **Frontend:** Blade Templates + Tailwind CSS (CDN)
* **Database:** MySQL
* **Scripting:** PHP 8.2+
                              
---

                         
###   Clone Repository                                                                  
Unduh source code atau clone repository ini:
```bash
git clone [https://github.com/millicentmoon/artspace-uas-wulan.git]
cd artspace                                                                