# 🍽️ RasaNusantara - Platform Resep Masakan Indonesia

## Cara Install (XAMPP / Laragon)

### Langkah 1 — Database
1. Buka **phpMyAdmin** → `http://localhost/phpmyadmin`
2. Buat database baru: **`rasanusantara`**
3. Klik **Import** → pilih file `database/rasanusantara.sql`
4. Klik **Go** → database siap ✓

### Langkah 2 — Konfigurasi `.env`
Edit file `.env` sesuaikan database Anda:
```
DB_DATABASE=rasanusantara
DB_USERNAME=root
DB_PASSWORD=          ← kosong jika tidak ada password
```

### Langkah 3 — Install Dependency
Buka terminal di folder project:
```bash
composer install
php artisan key:generate
php artisan storage:link
```

### Langkah 4 — Jalankan
```bash
php artisan serve
```
Buka: **http://localhost:8000**

---

## Akun Default

| Role  | Email                      | Password   |
|-------|----------------------------|------------|
| Admin | admin@rasanusantara.id     | password   |
| User  | budi@example.com           | password   |
| User  | siti@example.com           | password   |

---

## Fitur Lengkap

### Pengunjung / User
- ✅ Register & Login & Logout
- ✅ Lihat semua resep + detail resep
- ✅ Filter kategori & tingkat kesulitan
- ✅ **Pencarian berdasarkan bahan makanan** (Fitur Unggulan)
- ✅ Simpan & hapus favorit
- ✅ Rating bintang 1-5 & komentar ulasan
- ✅ Edit profil & riwayat aktivitas

### Admin (akses via /admin)
- ✅ Dashboard statistik lengkap
- ✅ Tambah / edit / hapus resep
- ✅ Tambah / edit / hapus kategori
- ✅ Kelola pengguna (edit role, hapus)
- ✅ Moderasi ulasan (approve/sembunyikan/hapus)
- ✅ Halaman statistik (resep terpopuler, kategori terfavorit)

---

## Teknologi
- **Laravel 12** + PHP 8.2+
- **MySQL** (phpMyAdmin)
- Pure CSS (dark gold theme, no Bootstrap)
- Blade Templating
