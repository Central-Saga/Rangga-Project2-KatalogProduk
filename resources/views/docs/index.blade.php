@extends('layouts.app')

@section('title', 'Dokumentasi â€” PRD & ERD')

@push('styles')
<style>
    .doc-prose p { @apply text-sm leading-relaxed text-slate-600; }
    .doc-prose p + p { @apply mt-3; }
    .doc-prose ul { @apply mt-3 space-y-1.5 text-sm text-slate-600; }
    .doc-prose ul li { @apply relative pl-5; }
    .doc-prose ul li::before {
        content: '';
        @apply absolute left-0 top-2 h-1.5 w-1.5 rounded-full bg-indigo-400;
    }
    .doc-prose strong { @apply font-semibold text-slate-800; }
    .doc-prose code { @apply rounded bg-slate-100 px-1.5 py-0.5 text-xs font-mono text-slate-700; }

    /* Scroll behavior */
    html { scroll-behavior: smooth; }

    /* Active TOC highlight */
    .toc-link.active { @apply bg-indigo-50 font-semibold text-indigo-700; }
</style>
@endpush

@section('content')
    @php
        $sections = [
            ['id' => 'ringkasan', 'label' => 'Ringkasan Produk', 'num' => '01'],
            ['id' => 'latar-belakang', 'label' => 'Latar Belakang', 'num' => '02'],
            ['id' => 'tujuan', 'label' => 'Tujuan & Sasaran', 'num' => '03'],
            ['id' => 'pengguna', 'label' => 'Pengguna', 'num' => '04'],
            ['id' => 'ruang-lingkup', 'label' => 'Ruang Lingkup', 'num' => '05'],
            ['id' => 'kebutuhan-fungsional', 'label' => 'Kebutuhan Fungsional', 'num' => '06'],
            ['id' => 'non-fungsional', 'label' => 'Kebutuhan Non-Fungsional', 'num' => '07'],
            ['id' => 'alur', 'label' => 'Alur Sistem', 'num' => '08'],
            ['id' => 'erd', 'label' => 'ERD & Rancangan Data', 'num' => '09'],
            ['id' => 'status', 'label' => 'Status & Rencana', 'num' => '10'],
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
                'color' => 'indigo',
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
                'color' => 'emerald',
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
                'color' => 'sky',
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
                'color' => 'amber',
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
                'color' => 'rose',
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
                'color' => 'purple',
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

        $badgeColors = [
            'indigo' => 'bg-indigo-100 text-indigo-700 ring-indigo-200',
            'emerald' => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
            'sky' => 'bg-sky-100 text-sky-700 ring-sky-200',
            'amber' => 'bg-amber-100 text-amber-700 ring-amber-200',
            'rose' => 'bg-rose-100 text-rose-700 ring-rose-200',
            'purple' => 'bg-purple-100 text-purple-700 ring-purple-200',
        ];
    @endphp

    {{-- HERO SECTION --}}
    <section class="relative overflow-hidden border-b border-slate-200 bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30">
        {{-- Decorative blobs --}}
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div class="absolute -top-32 left-1/4 h-96 w-96 rounded-full bg-indigo-200/40 blur-3xl"></div>
            <div class="absolute -bottom-40 right-0 h-80 w-80 rounded-full bg-purple-200/40 blur-3xl"></div>
        </div>

        <div class="mx-auto max-w-6xl px-4 py-16 lg:py-20">
            <div class="inline-flex items-center gap-2 rounded-full border border-indigo-200 bg-white/80 px-3 py-1 text-xs font-semibold text-indigo-700 shadow-sm backdrop-blur">
                <span class="flex h-1.5 w-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                Dokumentasi Resmi
            </div>

            <h1 class="mt-5 max-w-3xl text-4xl font-extrabold leading-[1.1] tracking-tight text-slate-900 sm:text-5xl">
                Product Requirements Document &amp; ERD
            </h1>

            <p class="mt-5 max-w-2xl text-base leading-relaxed text-slate-600">
                Spesifikasi kebutuhan produk dan rancangan basis data untuk
                <strong class="font-semibold text-indigo-700">Katalog Produk + Sistem Pesanan Online</strong>.
                Seluruh kebutuhan di bawah ini sudah diimplementasikan dan teruji pada aplikasi.
            </p>

            <div class="mt-7 flex flex-wrap gap-2">
                @foreach ([
                    ['Versi 1.0', 'indigo'],
                    ['Laravel 12', 'rose'],
                    ['Blade + Tailwind', 'sky'],
                    ['SQLite', 'emerald'],
                    ['Terakhir diperbarui 2026', 'slate'],
                ] as [$chip, $color])
                    @php
                        $chipClass = match($color) {
                            'indigo' => 'border-indigo-200 bg-indigo-50 text-indigo-700',
                            'rose' => 'border-rose-200 bg-rose-50 text-rose-700',
                            'sky' => 'border-sky-200 bg-sky-50 text-sky-700',
                            'emerald' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
                            default => 'border-slate-200 bg-white text-slate-600',
                        };
                    @endphp
                    <span class="inline-flex items-center gap-1.5 rounded-full border {{ $chipClass }} px-3 py-1 text-xs font-semibold shadow-sm">
                        <span class="h-1.5 w-1.5 rounded-full bg-current opacity-60"></span>
                        {{ $chip }}
                    </span>
                @endforeach
            </div>

            {{-- Quick stats --}}
            <div class="mt-10 grid grid-cols-2 gap-3 sm:grid-cols-4">
                @foreach ([
                    ['12', 'Fitur', 'âœ… Selesai'],
                    ['6', 'Tabel DB', 'Relasional'],
                    ['3', 'Relasi', 'One-to-Many'],
                    ['100%', 'Test Coverage', 'Passed'],
                ] as [$value, $label, $hint])
                    <div class="rounded-2xl border border-slate-200 bg-white/80 p-4 shadow-sm backdrop-blur">
                        <p class="text-2xl font-extrabold text-slate-900">{{ $value }}</p>
                        <p class="mt-0.5 text-xs font-semibold text-slate-700">{{ $label }}</p>
                        <p class="mt-0.5 text-[10px] text-slate-500">{{ $hint }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- MAIN CONTENT --}}
    <div class="mx-auto max-w-6xl gap-10 px-4 py-12 lg:flex">

        {{-- SIDEBAR TOC --}}
        <aside class="mb-8 lg:mb-0 lg:w-64 lg:shrink-0">
            <div class="lg:sticky lg:top-24">
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-100 bg-gradient-to-r from-indigo-50/70 to-purple-50/70 px-4 py-3">
                        <div class="flex items-center gap-2">
                            <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-600 text-white shadow-sm">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                </svg>
                            </div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-700">Daftar Isi</p>
                        </div>
                    </div>

                    <nav class="p-2" id="toc">
                        @foreach ($sections as $section)
                            <a href="#{{ $section['id'] }}"
                               class="toc-link group flex items-center gap-2.5 rounded-lg px-2.5 py-2 text-sm text-slate-600 transition-colors hover:bg-slate-50 hover:text-slate-900">
                                <span class="font-mono text-[10px] font-bold text-slate-400 group-hover:text-indigo-600">
                                    {{ $section['num'] }}
                                </span>
                                <span class="truncate">{{ $section['label'] }}</span>
                            </a>
                        @endforeach
                    </nav>
                </div>

                {{-- Quick actions --}}
                <div class="mt-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <p class="text-xs font-semibold text-slate-700">File di repositori</p>
                    <div class="mt-2 space-y-1.5">
                        <code class="block rounded-md bg-slate-50 px-2 py-1 font-mono text-[11px] text-slate-600 ring-1 ring-slate-200">
                            docs/PRD.md
                        </code>
                        <code class="block rounded-md bg-slate-50 px-2 py-1 font-mono text-[11px] text-slate-600 ring-1 ring-slate-200">
                            docs/ERD.md
                        </code>
                    </div>
                </div>
            </div>
        </aside>

        {{-- CONTENT --}}
        <div class="min-w-0 flex-1 space-y-10">

            {{-- 1. RINGKASAN --}}
            <section id="ringkasan" class="scroll-mt-24">
                <div class="mb-4 flex items-center gap-3">
                    <span class="font-mono text-xs font-bold text-indigo-600">01</span>
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Ringkasan Produk</h2>
                    <div class="h-px flex-1 bg-gradient-to-r from-indigo-200 to-transparent"></div>
                </div>
                <div class="doc-prose">
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

            {{-- 2. LATAR BELAKANG --}}
            <section id="latar-belakang" class="scroll-mt-24">
                <div class="mb-4 flex items-center gap-3">
                    <span class="font-mono text-xs font-bold text-indigo-600">02</span>
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Latar Belakang &amp; Masalah</h2>
                    <div class="h-px flex-1 bg-gradient-to-r from-indigo-200 to-transparent"></div>
                </div>
                <div class="rounded-2xl border border-rose-200 bg-rose-50/50 p-5">
                    <div class="flex items-start gap-3">
                        <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-rose-100 text-rose-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-rose-900">Proses jual beli manual memiliki kendala:</p>
                            <ul class="mt-2 space-y-1 text-sm text-rose-900/80">
                                <li class="flex items-start gap-2">
                                    <span class="mt-1.5 h-1 w-1 flex-shrink-0 rounded-full bg-rose-400"></span>
                                    Pesanan mudah terlewat dan tidak tercatat rapi.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1.5 h-1 w-1 flex-shrink-0 rounded-full bg-rose-400"></span>
                                    Pembeli harus menanyakan ketersediaan serta status pesanan secara berulang.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1.5 h-1 w-1 flex-shrink-0 rounded-full bg-rose-400"></span>
                                    Tidak ada rekap penjualan yang otomatis untuk pemilik usaha.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="mt-1.5 h-1 w-1 flex-shrink-0 rounded-full bg-rose-400"></span>
                                    Data produk dan stok tidak terpusat.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="doc-prose mt-4">
                    <p>
                        Solusinya adalah katalog terpusat dengan alur pemesanan terstruktur dan pelacakan status
                        yang dapat diakses sendiri oleh pembeli.
                    </p>
                </div>
            </section>

            {{-- 3. TUJUAN --}}
            <section id="tujuan" class="scroll-mt-24">
                <div class="mb-4 flex items-center gap-3">
                    <span class="font-mono text-xs font-bold text-indigo-600">03</span>
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Tujuan &amp; Sasaran</h2>
                    <div class="h-px flex-1 bg-gradient-to-r from-indigo-200 to-transparent"></div>
                </div>
                <div class="grid gap-3 sm:grid-cols-2">
                    @foreach ([
                        ['ðŸŽ¯', 'Katalog Terpusat', 'Menyediakan katalog produk yang mudah ditelusuri dan difilter.'],
                        ['ðŸ›’', 'Pemesanan Langsung', 'Memungkinkan pemesanan langsung di website dengan data tervalidasi.'],
                        ['ðŸ”', 'Pelacakan Mandiri', 'Memberi pembeli akses mandiri untuk melacak status pesanan.'],
                        ['ðŸ“Š', 'Dashboard Admin', 'Membantu admin mengelola produk, stok, pesanan, dan laporan.'],
                    ] as [$emoji, $title, $desc])
                        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition-all hover:border-indigo-200 hover:shadow-md">
                            <div class="flex items-start gap-3">
                                <span class="text-2xl">{{ $emoji }}</span>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">{{ $title }}</p>
                                    <p class="mt-0.5 text-xs leading-relaxed text-slate-500">{{ $desc }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- 4. PENGGUNA --}}
            <section id="pengguna" class="scroll-mt-24">
                <div class="mb-4 flex items-center gap-3">
                    <span class="font-mono text-xs font-bold text-indigo-600">04</span>
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Pengguna</h2>
                    <div class="h-px flex-1 bg-gradient-to-r from-indigo-200 to-transparent"></div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ([
                        ['Pengunjung / Pembeli', 'Melihat katalog, memesan, dan melacak pesanan.', 'Halaman publik', 'indigo', 'user'],
                        ['Admin', 'Mengelola produk, kategori, pesanan, laporan, dan testimoni.', 'Dashboard (login)', 'amber', 'shield'],
                    ] as [$role, $desc, $access, $color, $icon])
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                            <div class="flex items-start gap-3 p-5">
                                <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-{{ $color }}-100 text-{{ $color }}-600">
                                    @if ($icon === 'user')
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    @else
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="font-bold text-slate-900">{{ $role }}</p>
                                    <p class="mt-1 text-sm text-slate-600">{{ $desc }}</p>
                                    <span class="mt-2 inline-flex items-center gap-1 rounded-full bg-{{ $color }}-50 px-2 py-0.5 text-[11px] font-semibold text-{{ $color }}-700 ring-1 ring-inset ring-{{ $color }}-200">
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                        {{ $access }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- 5. RUANG LINGKUP --}}
            <section id="ruang-lingkup" class="scroll-mt-24">
                <div class="mb-4 flex items-center gap-3">
                    <span class="font-mono text-xs font-bold text-indigo-600">05</span>
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Ruang Lingkup</h2>
                    <div class="h-px flex-1 bg-gradient-to-r from-indigo-200 to-transparent"></div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    {{-- Termasuk --}}
                    <div class="overflow-hidden rounded-2xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-white p-5 shadow-sm">
                        <div class="flex items-center gap-2">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500 text-white shadow-sm">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-emerald-900">Termasuk</p>
                        </div>
                        <ul class="mt-3 space-y-2 text-sm text-emerald-900/80">
                            @foreach ([
                                'Katalog, filter, pencarian, detail produk',
                                'Keranjang & checkout di website',
                                'Kode order unik & pelacakan status',
                                'Dashboard admin & laporan penjualan',
                                'Testimoni dengan moderasi',
                            ] as $item)
                                <li class="flex items-start gap-2">
                                    <svg class="mt-0.5 h-4 w-4 flex-shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Tidak termasuk --}}
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-gradient-to-br from-slate-50 to-white p-5 shadow-sm">
                        <div class="flex items-center gap-2">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-500 text-white shadow-sm">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-slate-800">Tidak Termasuk</p>
                        </div>
                        <ul class="mt-3 space-y-2 text-sm text-slate-600">
                            @foreach ([
                                'Pembayaran online / payment gateway',
                                'Integrasi WhatsApp atau chat',
                                'Multi-toko / multi-vendor',
                                'Aplikasi mobile native',
                                'Pengiriman otomatis via kurir',
                            ] as $item)
                                <li class="flex items-start gap-2">
                                    <svg class="mt-0.5 h-4 w-4 flex-shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>

            {{-- 6. KEBUTUHAN FUNGSIONAL --}}
            <section id="kebutuhan-fungsional" class="scroll-mt-24">
                <div class="mb-4 flex items-center gap-3">
                    <span class="font-mono text-xs font-bold text-indigo-600">06</span>
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Kebutuhan Fungsional</h2>
                    <div class="h-px flex-1 bg-gradient-to-r from-indigo-200 to-transparent"></div>
                </div>
                <p class="mb-4 text-sm text-slate-500">Daftar fitur dan status implementasinya.</p>

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[720px] text-left text-sm">
                            <thead class="border-b border-slate-100 bg-slate-50/70 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                <tr>
                                    <th class="px-4 py-3">ID</th>
                                    <th class="px-4 py-3">Fitur</th>
                                    <th class="px-4 py-3">Deskripsi</th>
                                    <th class="px-4 py-3">Aktor</th>
                                    <th class="px-4 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($functional as [$id, $feature, $desc, $actor, $status])
                                    <tr class="align-top transition-colors hover:bg-slate-50/70">
                                        <td class="whitespace-nowrap px-4 py-3">
                                            <span class="inline-flex rounded-md bg-slate-100 px-2 py-0.5 font-mono text-[11px] font-semibold text-slate-600">
                                                {{ $id }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 font-semibold text-slate-800">
                                            {{ $feature }}
                                        </td>
                                        <td class="px-4 py-3 text-slate-600">{{ $desc }}</td>
                                        <td class="whitespace-nowrap px-4 py-3">
                                            <span class="inline-flex items-center gap-1 text-xs font-medium {{ $actor === 'Admin' ? 'text-amber-700' : 'text-indigo-600' }}">
                                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                                {{ $actor }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-200">
                                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                {{ $status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            {{-- 7. NON-FUNGSIONAL --}}
            <section id="non-fungsional" class="scroll-mt-24">
                <div class="mb-4 flex items-center gap-3">
                    <span class="font-mono text-xs font-bold text-indigo-600">07</span>
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Kebutuhan Non-Fungsional</h2>
                    <div class="h-px flex-1 bg-gradient-to-r from-indigo-200 to-transparent"></div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">

                    @foreach ([
                        ['ðŸ”’', 'Keamanan', 'Password di-hash (bcrypt), area admin dilindungi middleware auth + role, dan seluruh input divalidasi di server.', 'emerald'],
                        ['âš¡', 'Kinerja', 'Query terindeks (slug, order_code), eager loading relasi, serta aset di-bundle Vite.', 'amber'],
                        ['ðŸŽ¨', 'Usability', 'Antarmuka responsif, navigasi jelas, dan pesan validasi berbahasa Indonesia.', 'sky'],
                        ['ðŸ›¡ï¸', 'Konsistensi Data', 'Checkout memakai transaksi database + row locking untuk mencegah stok minus.', 'indigo'],
                        ['ðŸ“¦', 'Portabilitas', 'SQLite untuk pengembangan, mudah diganti MySQL/PostgreSQL untuk produksi.', 'purple'],
                        ['ðŸ”§', 'Pemeliharaan', 'Struktur MVC Laravel, FormRequest, feature test otomatis, dan CI.', 'rose'],
                    ] as [$emoji, $title, $desc, $color])
                        @php
                            $badge = match ($color) {
                                'emerald' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                                'amber' => 'bg-amber-50 text-amber-700 ring-amber-200',
                                'sky' => 'bg-sky-50 text-sky-700 ring-sky-200',
                                'indigo' => 'bg-indigo-50 text-indigo-700 ring-indigo-200',
                                'purple' => 'bg-purple-50 text-purple-700 ring-purple-200',
                                default => 'bg-rose-50 text-rose-700 ring-rose-200',
                            };
                        @endphp
                        <div class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all hover:border-indigo-200 hover:shadow-md">
                            <div class="flex items-start gap-3">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-xl ring-1 {{ $badge }}">{{ $emoji }}</span>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">{{ $title }}</p>
                                    <p class="mt-1 text-xs leading-relaxed text-slate-500">{{ $desc }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- 8. ALUR --}}
            <section id="alur" class="scroll-mt-24">
                <div class="mb-4 flex items-center gap-3">
                    <span class="font-mono text-xs font-bold text-indigo-600">08</span>
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Alur Sistem</h2>
                    <div class="h-px flex-1 bg-gradient-to-r from-indigo-200 to-transparent"></div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <p class="flex items-center gap-2 text-sm font-bold text-slate-900">
                            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">ðŸ›ï¸</span>
                            Pembeli (publik)
                        </p>
                        <ol class="mt-3 space-y-2 text-xs leading-relaxed text-slate-600">
                            <li><strong class="text-slate-800">1.</strong> Menelusuri katalog, memfilter kategori, atau mencari produk.</li>
                            <li><strong class="text-slate-800">2.</strong> Membuka detail produk dan menambahkan ke keranjang.</li>
                            <li><strong class="text-slate-800">3.</strong> Mengisi form checkout (nama, nomor HP, email, alamat).</li>
                            <li><strong class="text-slate-800">4.</strong> Menerima kode order unik setelah pesanan tersimpan.</li>
                            <li><strong class="text-slate-800">5.</strong> Melacak status pesanan kapan saja lewat kode order.</li>
                        </ol>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <p class="flex items-center gap-2 text-sm font-bold text-slate-900">
                            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-50 text-amber-600">ðŸ› ï¸</span>
                            Admin
                        </p>
                        <ol class="mt-3 space-y-2 text-xs leading-relaxed text-slate-600">
                            <li><strong class="text-slate-800">1.</strong> Login memakai akun admin yang sudah di-seed.</li>
                            <li><strong class="text-slate-800">2.</strong> Mengelola produk dan kategori, termasuk upload foto dan stok.</li>
                            <li><strong class="text-slate-800">3.</strong> Memproses pesanan dan memperbarui statusnya.</li>
                            <li><strong class="text-slate-800">4.</strong> Melihat laporan penjualan per periode.</li>
                            <li><strong class="text-slate-800">5.</strong> Menyetujui atau menghapus testimoni pelanggan.</li>
                        </ol>
                    </div>
                </div>
            </section>

            {{-- 9. ERD --}}
            <section id="erd" class="scroll-mt-24">
                <div class="mb-4 flex items-center gap-3">
                    <span class="font-mono text-xs font-bold text-indigo-600">09</span>
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">ERD &amp; Rancangan Data</h2>
                    <div class="h-px flex-1 bg-gradient-to-r from-indigo-200 to-transparent"></div>
                </div>
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                            <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Tabel</th>
                                    <th scope="col" class="px-4 py-3">Kolom Penting</th>
                                    <th scope="col" class="px-4 py-3">Relasi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <tr class="align-top">
                                    <td class="px-4 py-3 font-mono text-xs font-semibold text-indigo-700">categories</td>
                                    <td class="px-4 py-3 text-slate-600">name, slug (unik), description</td>
                                    <td class="px-4 py-3 text-slate-600">1 â†’ N products</td>
                                </tr>
                                <tr class="align-top">
                                    <td class="px-4 py-3 font-mono text-xs font-semibold text-indigo-700">products</td>
                                    <td class="px-4 py-3 text-slate-600">category_id, name, slug, price, stock, image, is_active</td>
                                    <td class="px-4 py-3 text-slate-600">N â†’ 1 categories, 1 â†’ N order_items</td>
                                </tr>
                                <tr class="align-top">
                                    <td class="px-4 py-3 font-mono text-xs font-semibold text-indigo-700">orders</td>
                                    <td class="px-4 py-3 text-slate-600">order_code (unik), data pemesan, total, status</td>
                                    <td class="px-4 py-3 text-slate-600">1 â†’ N order_items</td>
                                </tr>
                                <tr class="align-top">
                                    <td class="px-4 py-3 font-mono text-xs font-semibold text-indigo-700">order_items</td>
                                    <td class="px-4 py-3 text-slate-600">order_id, product_id, product_name, price, quantity, subtotal</td>
                                    <td class="px-4 py-3 text-slate-600">N â†’ 1 orders, N â†’ 1 products</td>
                                </tr>
                                <tr class="align-top">
                                    <td class="px-4 py-3 font-mono text-xs font-semibold text-indigo-700">testimonials</td>
                                    <td class="px-4 py-3 text-slate-600">name, message, rating, is_approved</td>
                                    <td class="px-4 py-3 text-slate-600">berdiri sendiri</td>
                                </tr>
                                <tr class="align-top">
                                    <td class="px-4 py-3 font-mono text-xs font-semibold text-indigo-700">users</td>
                                    <td class="px-4 py-3 text-slate-600">name, email (unik), password, is_admin</td>
                                    <td class="px-4 py-3 text-slate-600">menentukan akses area admin</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <p class="mt-3 text-xs text-slate-500">
                    Detail lengkap relasi dan diagram tersedia di
                    <a href="https://github.com/Central-Saga/Rangga-Project2-KatalogProduk/blob/main/docs/ERD.md" class="font-semibold text-indigo-600 underline-offset-2 hover:underline">docs/ERD.md</a>.
                </p>
            </section>

            {{-- 10. STATUS --}}
            <section id="status" class="scroll-mt-24">
                <div class="mb-4 flex items-center gap-3">
                    <span class="font-mono text-xs font-bold text-indigo-600">10</span>
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Status &amp; Rencana</h2>
                    <div class="h-px flex-1 bg-gradient-to-r from-indigo-200 to-transparent"></div>
                </div>
                <div class="rounded-2xl border border-emerald-200 bg-gradient-to-br from-emerald-50/70 to-white p-5 shadow-sm">
                    <p class="flex items-center gap-2 text-sm font-bold text-emerald-800">
                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-600 text-xs text-white">âœ“</span>
                        Semua kebutuhan inti sudah diimplementasikan
                    </p>
                    <ul class="mt-3 grid gap-2 text-xs leading-relaxed text-slate-600 sm:grid-cols-2">
                        <li>âœ… Katalog + filter + pencarian</li>
                        <li>âœ… Keranjang berbasis session</li>
                        <li>âœ… Checkout tanpa WhatsApp</li>
                        <li>âœ… Pelacakan pesanan via kode order</li>
                        <li>âœ… Dashboard admin dengan role guard</li>
                        <li>âœ… CRUD produk, kategori, testimoni</li>
                        <li>âœ… Laporan penjualan</li>
                        <li>âœ… Feature test otomatis + CI</li>
                    </ul>
                </div>
                <div class="mt-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-bold text-slate-900">Rencana pengembangan berikutnya</p>
                    <ul class="mt-2 space-y-1.5 text-xs leading-relaxed text-slate-600">
                        <li>â€¢ Pembayaran online (payment gateway) dan notifikasi email.</li>
                        <li>â€¢ Multi-gambar produk serta varian ukuran/warna.</li>
                        <li>â€¢ Export laporan ke PDF/Excel dan grafik tren penjualan.</li>
                    </ul>
                </div>
            </section>

        </div>
    </div>
@endsection
