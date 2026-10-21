@extends('layouts.app')

@section('title', 'Dokumentasi — PRD & ERD')

@section('content')
    @php
        $sections = [
            ['id' => 'ringkasan', 'label' => 'Ringkasan Produk'],
            ['id' => 'latar-belakang', 'label' => 'Latar Belakang'],
            ['id' => 'tujuan', 'label' => 'Tujuan & Sasaran'],
            ['id' => 'pengguna', 'label' => 'Pengguna'],
            ['id' => 'ruang-lingkup', 'label' => 'Ruang Lingkup'],
            ['id' => 'kebutuhan-fungsional', 'label' => 'Kebutuhan Fungsional'],
            ['id' => 'non-fungsional', 'label' => 'Kebutuhan Non-Fungsional'],
            ['id' => 'alur', 'label' => 'Alur Sistem'],
            ['id' => 'erd', 'label' => 'ERD & Rancangan Data'],
            ['id' => 'status', 'label' => 'Status & Rencana'],
        ];

        $functional = [
            ['FR-01', 'Lihat katalog', 'Menampilkan daftar produk aktif dengan filter kategori, pencarian, dan pengurutan.', 'Pengunjung', 'Selesai'],
            ['FR-02', 'Detail produk', 'Menampilkan foto, deskripsi, harga, stok, dan produk serupa.', 'Pengunjung', 'Selesai'],
            ['FR-03', 'Keranjang', 'Menambah, mengubah jumlah, menghapus, dan mengosongkan keranjang (berbasis session).', 'Pengunjung', 'Selesai'],
            ['FR-04', 'Checkout', 'Menyimpan pesanan + rincian item, membuat kode order unik, dan mengurangi stok.', 'Pengunjung', 'Selesai'],
            ['FR-05', 'Lacak pesanan', 'Mencari pesanan berdasarkan kode order dan menampilkan timeline status.', 'Pengunjung', 'Selesai'],
            ['FR-06', 'Testimoni', 'Mengirim testimoni; hanya tampil setelah disetujui admin.', 'Pengunjung', 'Selesai'],
            ['FR-07', 'Autentikasi admin', 'Login/logout dengan password ter-hash dan proteksi seluruh halaman admin.', 'Admin', 'Selesai'],
            ['FR-08', 'Kelola produk', 'CRUD produk termasuk upload foto, stok, dan status aktif.', 'Admin', 'Selesai'],
            ['FR-09', 'Kelola kategori', 'CRUD kategori beserta slug unik.', 'Admin', 'Selesai'],
            ['FR-10', 'Kelola pesanan', 'Melihat semua pesanan dan mengubah statusnya.', 'Admin', 'Selesai'],
            ['FR-11', 'Laporan penjualan', 'Ringkasan pendapatan, jumlah order, produk terlaris, dan rekap per status.', 'Admin', 'Selesai'],
            ['FR-12', 'Kelola testimoni', 'Menyetujui, membatalkan, dan menghapus testimoni.', 'Admin', 'Selesai'],
        ];

        $entities = [
            [
                'name' => 'categories',
                'desc' => 'Kategori produk',
                'columns' => [
                    ['id', 'bigint', 'PK'],
                    ['name', 'string', ''],
                    ['slug', 'string', 'UK'],
                    ['description', 'text', ''],
                ],
            ],
            [
                'name' => 'products',
                'desc' => 'Produk yang dijual',
                'columns' => [
                    ['id', 'bigint', 'PK'],
                    ['category_id', 'bigint', 'FK'],
                    ['name', 'string', ''],
                    ['slug', 'string', 'UK'],
                    ['price', 'bigint', ''],
                    ['stock', 'integer', ''],
                    ['image', 'string', ''],
                    ['is_active', 'boolean', ''],
                ],
            ],
            [
                'name' => 'orders',
                'desc' => 'Pesanan pelanggan',
                'columns' => [
                    ['id', 'bigint', 'PK'],
                    ['order_code', 'string', 'UK'],
                    ['customer_name', 'string', ''],
                    ['customer_phone', 'string', ''],
                    ['customer_email', 'string', ''],
                    ['address', 'text', ''],
                    ['total', 'bigint', ''],
                    ['status', 'enum', ''],
                ],
            ],
            [
                'name' => 'order_items',
                'desc' => 'Rincian item pesanan',
                'columns' => [
                    ['id', 'bigint', 'PK'],
                    ['order_id', 'bigint', 'FK'],
                    ['product_id', 'bigint', 'FK'],
                    ['product_name', 'string', ''],
                    ['price', 'bigint', ''],
                    ['quantity', 'integer', ''],
                    ['subtotal', 'bigint', ''],
                ],
            ],
            [
                'name' => 'testimonials',
                'desc' => 'Testimoni pelanggan',
                'columns' => [
                    ['id', 'bigint', 'PK'],
                    ['name', 'string', ''],
                    ['email', 'string', ''],
                    ['message', 'text', ''],
                    ['rating', 'tinyint', ''],
                    ['is_approved', 'boolean', ''],
                ],
            ],
            [
                'name' => 'users',
                'desc' => 'Akun admin',
                'columns' => [
                    ['id', 'bigint', 'PK'],
                    ['name', 'string', ''],
                    ['email', 'string', 'UK'],
                    ['password', 'string', ''],
                ],
            ],
        ];

        $relations = [
            ['categories', '1 : N', 'products', 'Satu kategori memiliki banyak produk (cascade).'],
            ['orders', '1 : N', 'order_items', 'Satu pesanan memiliki banyak item (cascade).'],
            ['products', '1 : N', 'order_items', 'Produk dapat muncul di banyak item (set null saat dihapus).'],
        ];

        $mermaid = <<<'MERMAID'
erDiagram
    CATEGORIES ||--o{ PRODUCTS : memiliki
    ORDERS ||--o{ ORDER_ITEMS : berisi
    PRODUCTS ||--o{ ORDER_ITEMS : dipesan
MERMAID;
    @endphp

    <section class="relative overflow-hidden border-b border-slate-200 bg-white">
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div class="absolute -top-32 right-0 h-80 w-80 rounded-full bg-indigo-100/60 blur-3xl"></div>
        </div>
        <div class="mx-auto max-w-6xl px-4 py-14">
            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-indigo-600">Dokumentasi</p>
            <h1 class="mt-3 max-w-3xl text-3xl font-semibold leading-tight tracking-tight text-slate-900 sm:text-4xl">
                Product Requirements Document &amp; ERD
            </h1>
            <p class="mt-4 max-w-2xl text-base leading-relaxed text-slate-600">
                Spesifikasi kebutuhan produk dan rancangan basis data untuk
                <strong class="font-semibold text-slate-800">Katalog Produk + Sistem Pesanan Online</strong>.
                Seluruh kebutuhan di bawah ini sudah diimplementasikan pada aplikasi.
            </p>
            <div class="mt-6 flex flex-wrap gap-2 text-xs">
                @foreach (['Versi 1.0', 'Laravel 12', 'Blade + Tailwind', 'SQLite', 'Terakhir diperbarui 2026'] as $chip)
                    <span class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 font-medium text-slate-600">{{ $chip }}</span>
                @endforeach
            </div>
        </div>
    </section>

    <div class="mx-auto max-w-6xl gap-10 px-4 py-12 lg:flex">
        <aside class="mb-8 lg:mb-0 lg:w-60 lg:shrink-0">
            <div class="lg:sticky lg:top-24">
                <p class="mb-3 text-[11px] font-semibold uppercase tracking-wider text-slate-500">Daftar isi</p>
                <nav class="grid grid-cols-2 gap-1 text-sm lg:grid-cols-1">
                    @foreach ($sections as $section)
                        <a href="#{{ $section['id'] }}" class="rounded-lg px-3 py-1.5 text-slate-500 transition hover:bg-slate-100 hover:text-slate-900">
                            {{ $section['label'] }}
                        </a>
                    @endforeach
                </nav>
            </div>
        </aside>

        <div class="min-w-0 flex-1 space-y-12">
            <section id="ringkasan" class="scroll-mt-24">
                <h2 class="text-xl font-semibold text-slate-900">1. Ringkasan Produk</h2>
                <div class="doc-prose mt-3">
                    <p>
                        Aplikasi web yang menggabungkan <strong>katalog produk</strong> dengan <strong>sistem pesanan online</strong>
                        tanpa perantara WhatsApp. Pengunjung dapat menelusuri produk, memasukkan ke keranjang, melakukan
                        checkout, dan melacak status pesanan menggunakan kode order. Admin mengelola produk, kategori,
                        pesanan, laporan penjualan, dan testimoni melalui dashboard yang terlindungi.
                    </p>
                    <p>
                        Semua transaksi tercatat pada database relasional, sehingga status pesanan konsisten dan dapat
                        ditelusuri kapan saja.
                    </p>
                </div>
            </section>

            <section id="latar-belakang" class="scroll-mt-24">
                <h2 class="text-xl font-semibold text-slate-900">2. Latar Belakang &amp; Masalah</h2>
                <div class="doc-prose mt-3">
                    <p>Proses jual beli yang masih mengandalkan chat manual memiliki beberapa kendala:</p>
                    <ul>
                        <li>Pesanan mudah terlewat dan tidak tercatat rapi.</li>
                        <li>Pembeli harus menanyakan ketersediaan serta status pesanan secara berulang.</li>
                        <li>Tidak ada rekap penjualan yang otomatis untuk pemilik usaha.</li>
                        <li>Data produk dan stok tidak terpusat.</li>
                    </ul>
                    <p>
                        Solusinya adalah katalog terpusat dengan alur pemesanan terstruktur dan pelacakan status
                        yang dapat diakses sendiri oleh pembeli.
                    </p>
                </div>
            </section>

            <section id="tujuan" class="scroll-mt-24">
                <h2 class="text-xl font-semibold text-slate-900">3. Tujuan &amp; Sasaran</h2>
                <div class="doc-prose mt-3">
                    <ul>
                        <li>Menyediakan katalog produk yang mudah ditelusuri dan difilter.</li>
                        <li>Memungkinkan pemesanan langsung di website dengan data yang tervalidasi.</li>
                        <li>Memberi pembeli akses mandiri untuk melacak status pesanan.</li>
                        <li>Membantu admin mengelola produk, stok, pesanan, dan laporan dalam satu dashboard.</li>
                    </ul>
                </div>
            </section>

            <section id="pengguna" class="scroll-mt-24">
                <h2 class="text-xl font-semibold text-slate-900">4. Pengguna</h2>
                <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-4 py-3 font-semibold">Peran</th>
                                <th class="px-4 py-3 font-semibold">Deskripsi</th>
                                <th class="px-4 py-3 font-semibold">Akses</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-600">
                            <tr>
                                <td class="px-4 py-3 font-medium text-slate-900">Pengunjung / Pembeli</td>
                                <td class="px-4 py-3">Melihat katalog, memesan, dan melacak pesanan.</td>
                                <td class="px-4 py-3">Halaman publik</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 font-medium text-slate-900">Admin</td>
                                <td class="px-4 py-3">Mengelola produk, kategori, pesanan, laporan, dan testimoni.</td>
                                <td class="px-4 py-3">Dashboard (login)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <section id="ruang-lingkup" class="scroll-mt-24">
                <h2 class="text-xl font-semibold text-slate-900">5. Ruang Lingkup</h2>
                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50/60 p-5">
                        <p class="text-sm font-semibold text-emerald-800">Termasuk</p>
                        <ul class="mt-2 space-y-1.5 text-sm text-emerald-900/80">
                            <li>Katalog, filter, pencarian, detail produk</li>
                            <li>Keranjang &amp; checkout di website</li>
                            <li>Kode order unik &amp; pelacakan status</li>
                            <li>Dashboard admin &amp; laporan penjualan</li>
                            <li>Testimoni dengan moderasi</li>
                        </ul>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-sm font-semibold text-slate-700">Tidak termasuk</p>
                        <ul class="mt-2 space-y-1.5 text-sm text-slate-600">
                            <li>Pembayaran online / payment gateway</li>
                            <li>Integrasi WhatsApp atau chat</li>
                            <li>Multi-toko / multi-vendor</li>
                            <li>Aplikasi mobile native</li>
                            <li>Pengiriman otomatis via kurir</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section id="kebutuhan-fungsional" class="scroll-mt-24">
                <h2 class="text-xl font-semibold text-slate-900">6. Kebutuhan Fungsional</h2>
                <p class="mt-1 text-sm text-slate-500">Daftar fitur dan status implementasinya.</p>
                <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200">
                    <table class="w-full min-w-[720px] text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-4 py-3 font-semibold">ID</th>
                                <th class="px-4 py-3 font-semibold">Fitur</th>
                                <th class="px-4 py-3 font-semibold">Deskripsi</th>
                                <th class="px-4 py-3 font-semibold">Aktor</th>
                                <th class="px-4 py-3 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-600">
                            @foreach ($functional as [$id, $feature, $desc, $actor, $status])
                                <tr class="align-top">
                                    <td class="whitespace-nowrap px-4 py-3 font-mono text-xs text-slate-400">{{ $id }}</td>
                                    <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-900">{{ $feature }}</td>
                                    <td class="px-4 py-3">{{ $desc }}</td>
                                    <td class="whitespace-nowrap px-4 py-3">{{ $actor }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>{{ $status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <section id="non-fungsional" class="scroll-mt-24">
                <h2 class="text-xl font-semibold text-slate-900">7. Kebutuhan Non-Fungsional</h2>
                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    @foreach ([
                        ['Keamanan', 'Password admin di-hash (bcrypt), halaman admin dilindungi middleware auth, dan seluruh input divalidasi di server.'],
                        ['Kinerja', 'Query terindeks (slug, order_code), eager loading relasi, serta aset di-bundle Vite.'],
                        ['Usability', 'Antarmuka responsif, navigasi jelas, dan pesan validasi berbahasa Indonesia.'],
                        ['Konsistensi Data', 'Checkout memakai transaksi database + row locking untuk mencegah stok minus.'],
                        ['Portabilitas', 'SQLite untuk pengembangan, mudah diganti MySQL/PostgreSQL untuk produksi.'],
                        ['Pemeliharaan', 'Struktur MVC Laravel, FormRequest, dan feature test otomatis.'],
                    ] as [$title, $desc])
                        <div class="rounded-2xl border border-slate-200 bg-white p-5">
                            <p class="text-sm font-semibold text-slate-900">{{ $title }}</p>
                            <p class="mt-1 text-sm leading-relaxed text-slate-500">{{ $desc }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <section id="alur" class="scroll-mt-24">
                <h2 class="text-xl font-semibold text-slate-900">8. Alur Sistem</h2>
                <div class="mt-4 space-y-3">
                    @foreach ([
                        ['Pembeli memilih produk', 'Katalog → filter/pencarian → detail produk → tambah ke keranjang.'],
                        ['Checkout', 'Isi data pemesan & alamat → sistem memvalidasi → membuat kode order → mengurangi stok.'],
                        ['Pemantauan', 'Pembeli membuka halaman lacak dan memasukkan kode order untuk melihat status.'],
                        ['Pemrosesan admin', 'Admin memverifikasi pesanan dan memperbarui status: diproses → dikirim → selesai.'],
                        ['Pelaporan', 'Dashboard menampilkan pendapatan, produk terlaris, dan rekap per status.'],
                    ] as $index => [$title, $desc])
                        <div class="flex gap-4 rounded-2xl border border-slate-200 bg-white p-4">
                            <span class="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-slate-900 text-xs font-semibold text-white">{{ $index + 1 }}</span>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">{{ $title }}</p>
                                <p class="mt-0.5 text-sm text-slate-500">{{ $desc }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section id="erd" class="scroll-mt-24">
                <h2 class="text-xl font-semibold text-slate-900">9. ERD &amp; Rancangan Data</h2>
                <p class="mt-1 text-sm text-slate-500">Enam tabel utama dengan relasi one-to-many.</p>

                <div class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($entities as $entity)
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
                            <div class="border-b border-slate-200 bg-slate-50 px-4 py-3">
                                <p class="font-mono text-sm font-semibold text-slate-900">{{ $entity['name'] }}</p>
                                <p class="text-xs text-slate-500">{{ $entity['desc'] }}</p>
                            </div>
                            <ul class="divide-y divide-slate-100 text-sm">
                                @foreach ($entity['columns'] as [$col, $type, $key])
                                    <li class="flex items-center justify-between gap-3 px-4 py-2">
                                        <span class="font-mono text-xs text-slate-700">{{ $col }}</span>
                                        <span class="flex items-center gap-2">
                                            <span class="text-[11px] text-slate-400">{{ $type }}</span>
                                            @if ($key)
                                                <span class="rounded bg-indigo-50 px-1.5 py-0.5 text-[10px] font-semibold text-indigo-700">{{ $key }}</span>
                                            @endif
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>

                <h3 class="mt-8 text-sm font-semibold uppercase tracking-wider text-slate-500">Relasi Antar Tabel</h3>
                <div class="mt-3 overflow-hidden rounded-2xl border border-slate-200">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-4 py-3 font-semibold">Tabel</th>
                                <th class="px-4 py-3 font-semibold">Kardinalitas</th>
                                <th class="px-4 py-3 font-semibold">Tabel</th>
                                <th class="px-4 py-3 font-semibold">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-600">
                            @foreach ($relations as [$from, $card, $to, $note])
                                <tr>
                                    <td class="px-4 py-3 font-mono text-xs text-slate-900">{{ $from }}</td>
                                    <td class="px-4 py-3 text-slate-500">{{ $card }}</td>
                                    <td class="px-4 py-3 font-mono text-xs text-slate-900">{{ $to }}</td>
                                    <td class="px-4 py-3">{{ $note }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-950 p-5">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Diagram Mermaid</p>
                        <span class="text-[11px] text-slate-500">tempel di mermaid.live</span>
                    </div>
                    <pre class="mt-3 overflow-x-auto text-xs leading-relaxed text-slate-300"><code>{{ $mermaid }}</code></pre>
                </div>

                <div class="mt-4 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                    <strong class="font-semibold">Catatan:</strong> <code class="rounded bg-amber-100 px-1">order_items</code>
                    menyimpan snapshot <code class="rounded bg-amber-100 px-1">product_name</code> dan
                    <code class="rounded bg-amber-100 px-1">price</code> agar riwayat transaksi tidak berubah saat produk diedit.
                    Stok berkurang otomatis di dalam transaksi database.
                </div>
            </section>

            <section id="status" class="scroll-mt-24">
                <h2 class="text-xl font-semibold text-slate-900">10. Status &amp; Rencana</h2>
                <div class="doc-prose mt-3">
                    <p>Seluruh kebutuhan fungsional (FR-01 s.d. FR-12) telah diimplementasikan dan diuji dengan feature test otomatis.</p>
                    <p class="mb-2"><strong>Rencana pengembangan berikutnya:</strong></p>
                    <ul>
                        <li>Integrasi pembayaran online (mis. Midtrans) dan bukti transfer.</li>
                        <li>Notifikasi email/WhatsApp untuk perubahan status pesanan.</li>
                        <li>Manajemen ongkos kirim dan integrasi kurir.</li>
                        <li>Halaman akun pelanggan dan riwayat pesanan.</li>
                    </ul>
                </div>
            </section>

            <div class="border-t border-slate-200 pt-6 text-sm text-slate-500">
                Dokumentasi ini juga tersedia dalam bentuk berkas di repositori:
                <code class="rounded bg-slate-100 px-1.5 py-0.5 text-xs text-slate-700">docs/PRD.md</code> dan
                <code class="rounded bg-slate-100 px-1.5 py-0.5 text-xs text-slate-700">docs/ERD.md</code>.
            </div>
        </div>
    </div>
@endsection
