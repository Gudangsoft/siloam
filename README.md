# Website Kampus — Laravel CMS

Sistem manajemen website kampus berbasis Laravel 13 yang dirancang untuk institusi pendidikan tinggi. Mendukung pengelolaan konten secara penuh melalui panel admin tanpa perlu memahami kode pemrograman.

---

## Daftar Isi

- [Fitur](#fitur)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Setup Wizard](#setup-wizard)
- [Panduan Admin Panel](#panduan-admin-panel)
- [Konfigurasi Lanjutan](#konfigurasi-lanjutan)
- [Deploy ke Server Production](#deploy-ke-server-production)
- [Penggunaan untuk Kampus Lain](#penggunaan-untuk-kampus-lain)

---

## Fitur

### Frontend (Publik)
| Halaman | Keterangan |
|---------|------------|
| Beranda | Banner slider, statistik kampus, berita terkini, sambutan pimpinan |
| Profil Kampus | Sejarah, Visi & Misi, Struktur Organisasi, Pimpinan, Dosen & Staf, Fasilitas, Akreditasi, Lokasi |
| Akademik | Program Studi, Kalender Akademik, Kurikulum, E-Learning, Perpustakaan |
| PMB | Info pendaftaran, syarat, biaya, beasiswa, jadwal, formulir pendaftaran online |
| Penelitian | Daftar artikel & kegiatan penelitian |
| Berita & Artikel | Berita kampus dengan kategori dan pencarian |
| Media | Agenda kegiatan, Galeri foto, Video YouTube |
| Kemahasiswaan | Organisasi, Prestasi, Alumni, Layanan, Karir |
| Kerjasama | Mitra dan kerjasama institusi |
| Kontak | Formulir pesan dengan verifikasi CAPTCHA matematika |
| Halaman Statis | Halaman bebas dengan slug URL custom |

### Admin Panel
| Modul | Fitur |
|-------|-------|
| Dashboard | Statistik ringkas, quick-action, notifikasi PMB & pesan baru |
| Banner Beranda | Upload gambar, judul, teks, tombol CTA |
| Berita & Artikel | Editor rich-text (Summernote), upload foto, kategori |
| Agenda & Kegiatan | Jadwal kegiatan dengan tanggal mulai-selesai |
| Galeri Foto | Upload massal (bulk), kategorisasi |
| Video | Embed video YouTube |
| Dosen & Staf | Data lengkap: NIDN, NUPTK, pendidikan, keahlian, foto, kategori (pimpinan/dosen/tendik) |
| Fasilitas | Foto dan deskripsi fasilitas kampus |
| Program Studi | Nama, jenjang, akreditasi, deskripsi |
| Kalender Akademik | Jadwal kegiatan akademik tahunan |
| Beasiswa | Daftar program beasiswa |
| Penelitian | Artikel dan kegiatan penelitian dosen |
| Organisasi Mahasiswa | UKM dan organisasi kemahasiswaan |
| Prestasi Mahasiswa | Dokumentasi prestasi dan penghargaan |
| Alumni | Data alumni dengan tahun lulus dan pekerjaan |
| Kerjasama | Data mitra dan dokumen MoU |
| Profil Konten | Edit konten Sejarah, Visi-Misi, E-Learning, Perpustakaan, PMB |
| Halaman Lainnya | Buat halaman bebas dengan URL slug custom |
| Navigasi Website | Kelola menu header & footer secara dinamis |
| PMB Registrasi | Lihat, filter data pendaftar, unduh foto & dokumen |
| Pesan Masuk | Kelola pesan dari formulir kontak |
| Pengaturan | Identitas kampus, kontak, media sosial, logo, favicon, foto pimpinan |

---

## Persyaratan Sistem

| Komponen | Versi Minimum |
|----------|---------------|
| PHP | 8.3 |
| Composer | 2.x |
| Node.js | 18.x |
| npm | 9.x |
| Database | MySQL 8.0 / MariaDB 10.4 / PostgreSQL 14 / SQLite 3 |
| Web Server | Apache 2.4 / Nginx 1.18 |

**PHP Extensions:** `mbstring`, `openssl`, `pdo`, `pdo_mysql`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`, `gd`

---

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/Gudangsoft/siloam.git nama-folder
cd nama-folder
```

### 2. Install Dependensi

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env`, sesuaikan koneksi database:

```env
# MySQL / MariaDB
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=password_anda

# SQLite (untuk development lokal — paling mudah)
DB_CONNECTION=sqlite
```

Jika menggunakan SQLite, buat file database-nya dulu:

```bash
# Windows
echo "" > database/database.sqlite

# Linux / Mac
touch database/database.sqlite
```

### 4. Migrasi Database

```bash
php artisan migrate
```

Opsional — isi data pengaturan awal:

```bash
php artisan db:seed --class=SettingSeeder
```

### 5. Buat Symlink Storage

Agar foto dan file yang diupload bisa diakses dari browser:

```bash
php artisan storage:link
```

### 6. Build Asset Frontend

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Jalankan Aplikasi

```bash
php artisan serve
```

Buka **http://localhost:8000** — website publik  
Buka **http://localhost:8000/admin** — panel admin

---

## Setup Wizard

Setelah instalasi, jalankan wizard interaktif untuk mengisi identitas kampus dan membuat akun admin pertama:

```bash
php artisan app:setup
```

```
╔══════════════════════════════════════════╗
║        Setup Awal Website Kampus         ║
╚══════════════════════════════════════════╝

[ Identitas Kampus ]
 Nama kampus / institusi [Nama Kampus]: STT Siloam Medan
 Tagline (kosongkan untuk lewati): Melahirkan Pemimpin yang Takut Akan Tuhan
 Email resmi kampus: info@sttsiloam.ac.id
 Nomor telepon: +62618765432
 Alamat lengkap: Jl. Siloam No. 1, Medan

[ Akun Admin ]
 Nama admin [Administrator]: Admin
 Email admin: admin@sttsiloam.ac.id
 Password admin (min. 8 karakter): ********

✔ Setup selesai! Login di: http://localhost:8000/admin/login
```

---

## Panduan Admin Panel

### Login

Buka `/admin` atau `/admin/login`. Masukkan email dan password yang dibuat saat setup.

---

### Pengaturan Website

**Menu: Lainnya → Pengaturan Website**

Isi semua data ini sebelum website diluncurkan:

#### Identitas Institusi
| Field | Keterangan |
|-------|------------|
| Nama Institusi | Nama resmi kampus (wajib) |
| Tagline | Slogan singkat |
| Deskripsi Singkat | Tampil di hasil pencarian Google, maks. 160 karakter |
| Teks Footer | Teks hak cipta; kosongkan untuk format otomatis `© [tahun] [nama]` |
| Subjudul Login Admin | Teks di bawah nama kampus di halaman login admin |
| Logo Website | Format PNG/SVG/WebP, rekomendasi ukuran 200×60px |
| Favicon | Ikon tab browser, format ICO/PNG, ukuran 32×32px |

#### Sambutan Pimpinan
| Field | Keterangan |
|-------|------------|
| Nama Pimpinan | Nama lengkap dengan gelar |
| Jabatan / Gelar | Contoh: Ketua STT, Rektor |
| Sambutan / Kata Pimpinan | Teks sambutan yang tampil di beranda |
| Foto Pimpinan | Foto wajah persegi, min. 200×200px |

#### Google Maps Embed
1. Buka [Google Maps](https://maps.google.com)
2. Cari lokasi kampus → klik **Bagikan** → **Sematkan peta**
3. Salin kode `<iframe ...>` → tempel di kolom **Google Maps Embed**

---

### Mengelola Berita

1. **Berita & Artikel → Tambah Berita**
2. Isi judul, pilih kategori
3. Edit konten dengan rich-text editor (bisa insert gambar, tabel, link)
4. Upload foto utama (rekomendasi 1200×630px)
5. Set status **Terbit** → **Simpan**

> Isi "Meta Description" untuk membantu visibilitas di Google (maks. 160 karakter)

---

### Upload Galeri Foto

1. **Galeri Foto → Upload Foto**
2. Pilih beberapa foto sekaligus (bulk upload)
3. Isi judul album dan kategori → **Simpan**

---

### Mengelola Dosen & Staf

1. **Profil Kampus → Dosen & Staf → Tambah Dosen/Staf**
2. Pilih **Kategori**: Pimpinan / Dosen / Tenaga Kependidikan
3. Isi nama lengkap beserta gelar akademik
4. Isi NIDN (10 digit, khusus dosen aktif) dan/atau NUPTK (16 digit)
5. Upload foto wajah (rasio 1:1, min. 200×200px)
6. Atur **Urutan Tampil** — angka kecil tampil lebih dulu
7. Aktifkan **Tampilkan di Website** → **Simpan**

---

### Mengelola PMB

**Setup konten halaman PMB:**
- Buka **PMB → Info PMB**
- Edit konten halaman: utama, syarat, biaya, beasiswa, dan jadwal

**Melihat data pendaftar:**
- Buka **PMB → Data Pendaftar**
- Klik nama pendaftar untuk detail lengkap (foto, dokumen ijazah)

---

### Konten Profil Kampus

Untuk **Sejarah** dan **Visi & Misi**:
- Buka **Profil Kampus → Edit Sejarah** (atau Edit Visi & Misi)
- Edit konten dengan rich-text editor → **Simpan**

> Titik berwarna di sidebar: **hijau** = konten sudah diisi, **oranye** = belum diisi

---

### Navigasi Website

1. **Lainnya → Navigasi Website → Tambah Menu**
2. Isi label, URL tujuan, dan lokasi:
   - `main` = menu header navigasi atas
   - `footer` = menu di footer bawah
3. Sub-menu: pilih **Parent Menu** untuk membuat dropdown
4. Ubah urutan dengan drag-and-drop atau atur angka urutan

---

### Halaman Statis

Buat halaman bebas dengan URL custom:

1. **Lainnya → Halaman Lainnya → Buat Halaman Baru**
2. Isi judul dan **slug** (URL). Contoh: slug `tentang-kami` → URL `/halaman/tentang-kami`
3. Edit konten → **Publish** → **Simpan**

---

### Pesan Masuk (Kontak)

- **Lainnya → Pesan Masuk**
- Klik pesan untuk membaca isi lengkap
- Hapus pesan yang sudah ditindaklanjuti

---

## Konfigurasi Lanjutan

### Email Notifikasi (Opsional)

Untuk menerima notifikasi email saat ada pesan baru dari formulir kontak:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email@kampus.ac.id
MAIL_PASSWORD=app_password_google
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=email@kampus.ac.id
MAIL_FROM_NAME="Nama Kampus"
```

> Untuk Gmail: aktifkan **2-Step Verification** → buat **App Password** di Google Account → gunakan App Password di `MAIL_PASSWORD`

### Batas Upload File

Edit di `config/filesystems.php` atau ubah konfigurasi PHP (`php.ini`):

```ini
upload_max_filesize = 10M
post_max_size = 20M
```

---

## Deploy ke Server Production

### 1. Upload ke Server

```bash
# Via Git (cara terbaik)
git clone https://github.com/Gudangsoft/siloam.git /var/www/html/kampus
cd /var/www/html/kampus

composer install --optimize-autoloader --no-dev
npm install && npm run build
```

### 2. Konfigurasi `.env` Production

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://namadomain.ac.id

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=nama_db
DB_USERNAME=user_db
DB_PASSWORD=password_kuat
```

### 3. Jalankan Perintah Deployment

```bash
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan app:setup        # Isi identitas kampus & buat admin

# Optimasi cache (wajib di production)
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 4. Konfigurasi Web Server

**Nginx** — arahkan `root` ke folder `public/`:

```nginx
server {
    listen 80;
    server_name namadomain.ac.id www.namadomain.ac.id;
    root /var/www/html/kampus/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

**Apache** — file `.htaccess` sudah disertakan di `public/`. Aktifkan `mod_rewrite`:

```bash
a2enmod rewrite
systemctl restart apache2
```

Pastikan konfigurasi Apache mengizinkan `.htaccess`:

```apache
<Directory /var/www/html/kampus/public>
    AllowOverride All
</Directory>
```

### 5. Izin Folder Storage

```bash
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

### 6. HTTPS dengan Let's Encrypt (Gratis)

```bash
apt install certbot python3-certbot-nginx -y
certbot --nginx -d namadomain.ac.id -d www.namadomain.ac.id
```

---

## Penggunaan untuk Kampus Lain

Sistem ini dirancang untuk bisa di-deploy ke kampus mana pun tanpa mengubah kode — semua identitas institusi bersumber dari database, bukan hardcoded.

**Langkah deploy untuk kampus baru:**

```bash
# 1. Clone
git clone https://github.com/Gudangsoft/siloam.git website-kampus-baru
cd website-kampus-baru

# 2. Install & konfigurasi
composer install
npm install && npm run build
cp .env.example .env
# Edit .env: isi APP_URL dan DB_*
php artisan key:generate

# 3. Setup database
php artisan migrate --seed
php artisan storage:link

# 4. Isi identitas kampus & buat akun admin
php artisan app:setup

# 5. Selesai — login ke /admin
```

Setelah login, lengkapi di **Pengaturan Website**:
- Upload logo dan favicon kampus
- Isi foto pimpinan dan sambutan
- Lengkapi kontak dan Google Maps
- Hubungkan akun media sosial

---

## Struktur Direktori

```
├── app/
│   ├── Console/Commands/AppSetup.php     # Wizard setup awal
│   ├── Http/Controllers/Admin/           # 24 controller admin
│   ├── Http/Controllers/                 # Controller frontend
│   ├── Models/                           # 21 model Eloquent
│   └── Http/View/Composers/             # Settings global (tiap view)
├── database/
│   ├── migrations/                       # 29 migrasi tabel
│   └── seeders/SettingSeeder.php         # Data awal pengaturan
├── resources/views/
│   ├── layouts/frontend.blade.php        # Layout halaman publik
│   ├── layouts/admin.blade.php           # Layout panel admin
│   ├── frontend/                         # View halaman publik
│   └── admin/                            # View panel admin
├── public/                               # Document root web server
│   └── storage -> ../storage/app/public  # Symlink file upload
├── storage/app/public/                   # File yang diupload
│   ├── settings/                         # Logo, favicon, foto pimpinan
│   ├── staff/                            # Foto dosen & staf
│   ├── news/                             # Foto berita
│   ├── gallery/                          # Foto galeri
│   └── pmb/                              # Foto & dokumen pendaftar
└── .env                                  # Konfigurasi environment (jangan di-commit ke Git)
```

---

## Tech Stack

| Komponen | Teknologi |
|----------|-----------|
| Backend | Laravel 13 (PHP 8.3) |
| Authentication | Laravel Breeze |
| Admin UI | Bootstrap 5 + custom CSS |
| Rich Text Editor | Summernote 0.8 |
| Data Table | DataTables 1.13 |
| Frontend | Tailwind CSS (CDN) + AOS animations |
| Icons | Font Awesome 6 |
| Storage | Laravel Storage (local / S3-compatible) |
| HTML Sanitizer | mews/purifier |
| Database | Eloquent ORM (MySQL / SQLite / PostgreSQL) |
