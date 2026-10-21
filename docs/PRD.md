# PRD — Katalog Produk + Sistem Pesanan Online

**Versi:** 1.0 · **Stack:** Laravel 12 + Blade + Tailwind CSS 4 · **Database:** SQLite (dapat diganti MySQL/PostgreSQL)

> Dokumen ini juga tersedia sebagai halaman web di `/dokumentasi`.

## 1. Ringkasan Produk

Aplikasi web yang menggabungkan **katalog produk** dengan **sistem pesanan online** tanpa perantara
WhatsApp. Pengunjung dapat menelusuri produk, memasukkan ke keranjang, melakukan checkout, dan melacak
status pesanan menggunakan kode order. Admin mengelola produk, kategori, pesanan, laporan penjualan,
dan testimoni melalui dashboard yang terlindungi.

Semua transaksi tercatat pada database relasional sehingga status pesanan konsisten dan dapat
ditelesuri kapan saja.

## 2. Latar Belakang & Masalah

Proses jual beli yang masih mengandalkan chat manual memiliki kendala:

- Pesanan mudah terlewat dan tidak tercatat rapi.
- Pembeli harus menanyakan ketersediaan serta status pesanan secara berulang.
- Tidak ada rekap penjualan otomatis untuk pemilik usaha.
- Data produk dan stok tidak terpusat.

## 3. Tujuan & Sasaran

- Menyediakan katalog produk yang mudah ditelusuri dan difilter.
- Memungkinkan pemesanan langsung di website dengan data tervalidasi.
- Memberi pembeli akses mandiri untuk melacak status pesanan.
- Membantu admin mengelola produk, stok, pesanan, dan laporan dalam satu dashboard.

## 4. Pengguna

| Peran | Deskripsi | Akses |
|---|---|---|
| Pengunjung / Pembeli | Melihat katalog, memesan, dan melacak pesanan. | Halaman publik |
| Admin | Mengelola produk, kategori, pesanan, laporan, dan testimoni. | Dashboard (login) |

## 5. Ruang Lingkup

**Termasuk**
- Katalog, filter, pencarian, detail produk
- Keranjang & checkout di website
- Kode order unik & pelacakan status
- Dashboard admin & laporan penjualan
- Testimoni dengan moderasi

**Tidak termasuk**
- Pembayaran online / payment gateway
- Integrasi WhatsApp atau chat
- Multi-toko / multi-vendor
- Aplikasi mobile native
- Pengiriman otomatis via kurir

## 6. Kebutuhan Fungsional

| ID | Fitur | Deskripsi | Aktor | Status |
|---|---|---|---|---|
| FR-01 | Lihat katalog | Daftar produk aktif dengan filter kategori, pencarian, dan pengurutan. | Pengunjung | Selesai |
| FR-02 | Detail produk | Foto, deskripsi, harga, stok, dan produk serupa. | Pengunjung | Selesai |
| FR-03 | Keranjang | Tambah, ubah jumlah, hapus, kosongkan (session). | Pengunjung | Selesai |
| FR-04 | Checkout | Simpan pesanan + item, kode order unik, kurangi stok. | Pengunjung | Selesai |
| FR-05 | Lacak pesanan | Cari pesanan via kode order + timeline status. | Pengunjung | Selesai |
| FR-06 | Testimoni | Kirim testimoni; tampil setelah disetujui admin. | Pengunjung | Selesai |
| FR-07 | Autentikasi admin | Login/logout, password ter-hash, proteksi halaman admin. | Admin | Selesai |
| FR-08 | Kelola produk | CRUD produk + upload foto, stok, status aktif. | Admin | Selesai |
| FR-09 | Kelola kategori | CRUD kategori dengan slug unik. | Admin | Selesai |
| FR-10 | Kelola pesanan | Lihat semua pesanan dan ubah status. | Admin | Selesai |
| FR-11 | Laporan penjualan | Pendapatan, jumlah order, produk terlaris, rekap status. | Admin | Selesai |
| FR-12 | Kelola testimoni | Setujui, batalkan, hapus testimoni. | Admin | Selesai |

## 7. Kebutuhan Non-Fungsional

- **Keamanan** — password admin bcrypt, middleware auth, validasi server-side.
- **Kinerja** — indeks pada `slug`/`order_code`, eager loading, aset di-bundle Vite.
- **Usability** — responsif, navigasi jelas, pesan validasi bahasa Indonesia.
- **Konsistensi Data** — transaksi database + row locking saat checkout.
- **Portabilitas** — SQLite untuk dev, mudah diganti MySQL/PostgreSQL.
- **Pemeliharaan** — struktur MVC, FormRequest, feature test otomatis.

## 8. Alur Sistem

1. **Pembeli memilih produk** — katalog → filter/pencarian → detail → keranjang.
2. **Checkout** — isi data → validasi → kode order → stok berkurang.
3. **Pemantauan** — lacak pesanan dengan kode order.
4. **Pemrosesan admin** — ubah status: diproses → dikirim → selesai.
5. **Pelaporan** — dashboard menampilkan pendapatan & produk terlaris.

## 9. Rancangan Data (ERD)

Lihat [`ERD.md`](ERD.md) untuk detail relasi dan kolom.

| Tabel | Keterangan |
|---|---|
| `categories` | Kategori produk |
| `products` | Produk (`category_id`, harga, stok, gambar, aktif) |
| `orders` | Pesanan (`order_code`, data pemesan, total, status) |
| `order_items` | Rincian item (snapshot nama & harga) |
| `testimonials` | Testimoni (`rating`, `is_approved`) |
| `users` | Akun admin |

## 10. Status & Rencana

Seluruh FR-01 s.d. FR-12 telah diimplementasikan dan diuji dengan feature test otomatis.

**Rencana berikutnya:** pembayaran online (mis. Midtrans), notifikasi email/WhatsApp, manajemen ongkos
kirim, halaman akun pelanggan & riwayat pesanan.
