<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<h1 align="center">Perumahan SBM</h1>

<p align="center">
  Sistem informasi perumahan berbasis web — landing page cluster/unit rumah, form survey minat pembeli, dan panel admin untuk pengelolaan cluster, agent, dan data survey.
</p>

<p align="center">
  <img alt="Laravel" src="https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white">
  <img alt="PHP" src="https://img.shields.io/badge/PHP-8.3%2B-777BB4?logo=php&logoColor=white">
  <img alt="Tailwind CSS" src="https://img.shields.io/badge/Tailwind-v4-06B6D4?logo=tailwindcss&logoColor=white">
  <img alt="Vite" src="https://img.shields.io/badge/Vite-8-646CFF?logo=vite&logoColor=white">
</p>

---

## Tentang Project

**Perumahan SBM** adalah aplikasi web untuk menampilkan informasi perumahan/cluster kepada calon pembeli sekaligus mengelola minat pembeli (survey) dari sisi admin. Aplikasi ini dibangun dengan **Laravel 13**.

### Fitur Utama

- 🏠 **Landing page publik** — daftar cluster/unit rumah lengkap dengan tipe, harga, luas tanah/bangunan, jumlah kamar, dan status ketersediaan (Tersedia / Terbatas / Habis)
- 🔍 **Pencarian cluster** — filter unit berdasarkan nama atau tipe rumah
- 📝 **Form survey minat pembeli** — pengunjung mengisi data minat, dengan alur *pending submission* yang meminta verifikasi login/registrasi sebelum data tersimpan permanen
- 🔐 **Autentikasi terpisah** — login admin (`/admin/login`) dan login/registrasi publik untuk calon pembeli (`/login`, `/register`)
- 🛠️ **Panel admin**:
  - Dashboard ringkasan cluster & survey submission
  - CRUD cluster (tambah, edit, hapus, upload gambar)
  - Kelola data agent/kontak pemasaran
  - Kelola survey submission (lihat detail, proses, hapus)
- 📞 **Info agent** — kontak, jadwal, dan promo agent ditampilkan di landing page

### Tech Stack

| Layer | Teknologi |
|---|---|
| Backend | Laravel 13, PHP 8.3+ |
| Database | SQLite (default lokal) / MySQL (opsional) |
| Frontend build | Vite 8, Tailwind CSS v4 |
| View | Blade Templates |
| Testing | PHPUnit |
| Code style | Laravel Pint |

---

## Struktur Folder Penting

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AdminController.php     # Dashboard admin, CRUD cluster, kelola survey
│   │   └── AuthController.php      # Login admin, login/register publik, verifikasi
│   └── Middleware/
│       └── AdminMiddleware.php     # Proteksi route khusus admin
└── Models/
    ├── Agent.php                   # Data kontak/agent pemasaran
    ├── Cluster.php                 # Data cluster/unit rumah
    ├── Status.php                  # Status ketersediaan unit
    ├── SurveySubmission.php        # Data survey yang sudah terverifikasi
    ├── PendingSurveySubmission.php # Data survey menunggu verifikasi login
    └── User.php                    # Akun admin & pembeli (dibedakan lewat kolom role)

database/
├── migrations/                     # Struktur tabel
└── seeders/                        # Data awal (status, contoh cluster, agent, admin default)

resources/views/
├── welcome.blade.php               # Landing page publik
├── admin/                          # Dashboard, edit cluster, detail survey
├── auth/                           # Login, register, verifikasi
└── survey/                         # Konfirmasi survey submission

routes/
└── web.php                         # Semua route aplikasi
```

---

## Instalasi & Setup Lokal

### Prasyarat

- PHP >= 8.3
- Composer
- Node.js & npm
- Ekstensi PHP standar Laravel (`sqlite3` jika pakai database default)

### Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/ernesyafz/perumahansbm.git
cd perumahansbm

# 2. Install dependency PHP
composer install

# 3. Salin file environment & generate application key
cp .env.example .env
php artisan key:generate

# 4. Siapkan database (default: SQLite)
touch database/database.sqlite
php artisan migrate --seed

# 5. Buat symlink storage (untuk gambar cluster yang diupload)
php artisan storage:link

# 6. Install dependency frontend & build asset
npm install
npm run build
```

### Menjalankan Aplikasi

```bash
php artisan serve
```

Aplikasi berjalan di `http://127.0.0.1:8000`.

Untuk mode development dengan hot-reload asset:

```bash
npm run dev
```

### Akun Admin Default (dari seeder)

| Email | Password |
|---|---|
| `admin@sbm.test` | `password` |

> ⚠️ **Wajib diganti** sebelum deploy ke environment publik/production.

---

## Menjalankan Test

```bash
php artisan test
```

Test yang tersedia mencakup: login admin, kelola survey submission oleh admin, serta alur pending survey submission (termasuk kasus expired dan valid).

---

## Format Kode

Project ini menggunakan [Laravel Pint](https://laravel.com/docs/pint) untuk menjaga konsistensi gaya kode PHP:

```bash
./vendor/bin/pint
```

---

## Kontribusi / Pengembangan Lanjutan

Alur kerja pengembangan (branch, commit, pull request) mengikuti panduan di [`WORKFLOW-VSCODE-GITHUB.md`](./WORKFLOW-VSCODE-GITHUB.md).

Ringkas:

1. Buat branch baru dari `main` (`feat/...`, `fix/...`, `chore/...`)
2. Commit dengan format [Conventional Commits](https://www.conventionalcommits.org/)
3. Push branch & buat Pull Request ke `main`
4. Review & merge

---

## Lisensi

Project ini menggunakan framework [Laravel](https://laravel.com) yang berlisensi [MIT](https://opensource.org/licenses/MIT).