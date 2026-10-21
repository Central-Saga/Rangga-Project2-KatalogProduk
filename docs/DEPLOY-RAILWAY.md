# Deploy ke Railway

Proyek ini sudah dilengkapi `Dockerfile`, `docker-entrypoint.sh`, dan `railway.json`, sehingga Railway
dapat melakukan build & deploy otomatis.

## 1. Siapkan repository
```bash
git init
git add .
git commit -m "feat: katalog produk + sistem pesanan online"
# buat repo kosong di GitHub, lalu:
git remote add origin https://github.com/<user>/<repo>.git
git push -u origin main
```

## 2. Buat project di Railway
1. Buka <https://railway.app> → **New Project** → **Deploy from GitHub repo**.
2. Pilih repo proyek ini. Railway mendeteksi `Dockerfile` otomatis.

## 3. Tambahkan database
- Klik **New** → **Database** → **PostgreSQL** (disarankan) *atau* **MySQL**.
- Railway menyediakan variabel koneksi otomatis.

## 4. Set environment variables (service aplikasi → Variables)

| Variable | Nilai |
|---|---|
| `APP_NAME` | `Katalog Produk` |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_URL` | `https://<domain-railway>` |
| `APP_KEY` | hasil `php artisan key:generate --show` |
| `APP_TIMEZONE` | `Asia/Makassar` |
| `APP_LOCALE` | `id` |
| `DB_CONNECTION` | `pgsql` (atau `mysql`) |
| `DB_URL` | `${{Postgres.DATABASE_URL}}` (atau `${{MySQL.MYSQL_URL}}`) |
| `SESSION_DRIVER` | `database` |
| `CACHE_STORE` | `database` |
| `QUEUE_CONNECTION` | `sync` |
| `LOG_CHANNEL` | `stderr` |

> `APP_KEY` wajib sama setiap deploy. Buat sekali secara lokal:
> `php artisan key:generate --show` lalu salin hasilnya.

## 5. Seed data awal (sekali)
Setelah deploy pertama sukses, buka **service → Shell** lalu jalankan:
```bash
php artisan migrate --force
php artisan db:seed --force
```
Akun admin: `admin@katalog.test` / `password` (ganti setelah login untuk produksi).

## 6. Domain
Service → **Settings → Networking → Generate Domain**. Buka URL tersebut.

## Catatan penting
- **Upload foto produk** pada Railway bersifat *ephemeral* (hilang saat redeploy) karena filesystem
  container tidak persisten. Untuk produksi, gunakan object storage (S3/R2) atau Railway Volume.
- `SESSION_DRIVER` & `CACHE_STORE` diset `database` agar tidak bergantung pada filesystem.
- Entrypoint menjalankan `php artisan migrate --force` otomatis setiap start, sehingga perubahan
  skema ikut terpasang.
- Jangan commit `.env`; seluruh kredensial diisi lewat dashboard Railway.
