# SIM PDAM Desa

Sistem Informasi Manajemen PDAM Desa berbasis Laravel untuk membantu pengelolaan pelanggan, pencatatan meter air, pembuatan tagihan, pembayaran, pengaduan, dan laporan operasional.

## Fitur Utama

- Autentikasi dan pembagian hak akses berdasarkan role: admin, petugas, kasir, dan pelanggan.
- Dashboard ringkasan pelanggan aktif, pendapatan bulanan, tagihan belum bayar, pengaduan terbuka, dan progress pencatatan meter.
- Manajemen user, pelanggan, dan golongan tarif.
- Pencatatan meter pelanggan per periode, termasuk upload foto meter.
- Generate tagihan otomatis berdasarkan pemakaian dan golongan tarif.
- Penerapan denda untuk tagihan yang melewati jatuh tempo.
- Proses pembayaran tagihan dan cetak kuitansi.
- Modul pengaduan pelanggan dengan alur status baru, diproses, dan selesai.
- Portal pelanggan untuk melihat tagihan, riwayat pembayaran, pengaduan, dan profil.
- Laporan pelanggan, tagihan, dan pembayaran dengan export PDF/Excel.

## Teknologi

- PHP 8.2+
- Laravel 12
- SQLite/MySQL
- Blade Template
- Tailwind CSS
- Vite
- Laravel DomPDF
- Laravel Excel
- Pest/PHPUnit

## Kebutuhan Sistem

Pastikan perangkat sudah memiliki:

- PHP 8.2 atau lebih baru
- Composer
- Node.js dan npm
- SQLite atau MySQL
- Ekstensi PHP umum Laravel, seperti `pdo`, `mbstring`, `openssl`, `fileinfo`, dan `zip`

## Instalasi

Clone repository:

```bash
git clone https://github.com/username/sim-pdam-desa.git
cd sim-pdam-desa
```

Install dependency PHP dan JavaScript:

```bash
composer install
npm install
```

Buat file environment:

```bash
cp .env.example .env
php artisan key:generate
```

Atur database di file `.env`. Untuk SQLite, buat file database:

```bash
touch database/database.sqlite
```

Contoh konfigurasi SQLite:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/ke/project/database/database.sqlite
```

Jalankan migrasi dan seeder:

```bash
php artisan migrate --seed
```

Buat symbolic link storage untuk akses foto meter:

```bash
php artisan storage:link
```

Build asset frontend:

```bash
npm run build
```

Jalankan aplikasi:

```bash
php artisan serve
```

Aplikasi akan berjalan di:

```text
http://127.0.0.1:8000
```

Untuk mode development frontend, jalankan Vite di terminal terpisah:

```bash
npm run dev
```

## Akun Demo

Seeder menyediakan beberapa akun awal:

| Role | Email | Password |
| --- | --- | --- |
| Admin | admin@pdam.desa | admin123 |
| Petugas | petugas@pdam.desa | petugas123 |
| Kasir | kasir@pdam.desa | kasir123 |
| Pelanggan | budi@gmail.com | pelanggan123 |

## Role dan Akses

| Role | Akses |
| --- | --- |
| Admin | Dashboard, user, pelanggan, golongan tarif, pengaduan, tagihan, laporan |
| Petugas | Pencatatan meter dan data pelanggan |
| Kasir | Tagihan dan pembayaran |
| Pelanggan | Portal pelanggan, tagihan pribadi, pembayaran, pengaduan, profil |

## Perintah Berguna

Menjalankan test:

```bash
php artisan test
```

Format kode PHP:

```bash
vendor/bin/pint
```

Clear cache konfigurasi:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

Regenerate database dari awal:

```bash
php artisan migrate:fresh --seed
```

## Struktur Modul

```text
app/Http/Controllers   Controller aplikasi
app/Http/Requests      Validasi request form
app/Models             Model Eloquent
app/Services           Logic bisnis tagihan, meter, pembayaran, laporan
app/Exports            Export laporan Excel
database/migrations    Struktur tabel database
database/seeders       Data awal aplikasi
resources/views        Halaman Blade
routes/web.php         Route web aplikasi
```

## Export Laporan

Aplikasi mendukung export:

- PDF menggunakan `barryvdh/laravel-dompdf`
- Excel menggunakan `maatwebsite/excel`

Jenis laporan yang tersedia:

- Laporan tagihan per periode
- Laporan pembayaran berdasarkan rentang tanggal
- Laporan pelanggan

## Catatan Deployment

Saat deploy ke server production:

- Set `APP_ENV=production`
- Set `APP_DEBUG=false`
- Jalankan `composer install --no-dev --optimize-autoloader`
- Jalankan `npm run build`
- Jalankan `php artisan migrate --force`
- Pastikan folder `storage` dan `bootstrap/cache` writable
- Jalankan `php artisan storage:link` jika belum ada
- Atur web server agar document root mengarah ke folder `public`

## Lisensi

Project ini menggunakan lisensi MIT.
