# ERD — Katalog Produk + Sistem Pesanan Online

## Diagram Relasi (Mermaid)

```mermaid
erDiagram
    USERS {
        bigint id PK
        string name
        string email UK
        string password
        timestamp created_at
        timestamp updated_at
    }

    CATEGORIES {
        bigint id PK
        string name
        string slug UK
        text description
        timestamp created_at
        timestamp updated_at
    }

    PRODUCTS {
        bigint id PK
        bigint category_id FK
        string name
        string slug UK
        text description
        bigint price
        int stock
        string image
        boolean is_active
        timestamp created_at
        timestamp updated_at
    }

    ORDERS {
        bigint id PK
        string order_code UK
        string customer_name
        string customer_phone
        string customer_email
        text address
        text notes
        bigint total
        enum status
        timestamp created_at
        timestamp updated_at
    }

    ORDER_ITEMS {
        bigint id PK
        bigint order_id FK
        bigint product_id FK
        string product_name
        bigint price
        int quantity
        bigint subtotal
        timestamp created_at
        timestamp updated_at
    }

    TESTIMONIALS {
        bigint id PK
        string name
        string email
        text message
        tinyint rating
        boolean is_approved
        timestamp created_at
        timestamp updated_at
    }

    CATEGORIES ||--o{ PRODUCTS : "memiliki"
    ORDERS ||--o{ ORDER_ITEMS : "berisi"
    PRODUCTS ||--o{ ORDER_ITEMS : "dipesan"
```

## Relasi

| Relasi | Jenis | Keterangan |
|---|---|---|
| `categories` – `products` | 1 : N | Satu kategori memiliki banyak produk. |
| `orders` – `order_items` | 1 : N | Satu pesanan memiliki banyak item. |
| `products` – `order_items` | 1 : N | Satu produk bisa muncul di banyak item pesanan. |
| `users` | — | Akun admin untuk login dashboard (session auth). |

## Aturan Foreign Key (`onDelete`)

| Kolom FK | Referensi | onDelete | Alasan |
|---|---|---|---|
| `products.category_id` | `categories.id` | `cascade` | Produk mengikuti siklus kategori. |
| `order_items.order_id` | `orders.id` | `cascade` | Item mengikuti pesanannya. |
| `order_items.product_id` | `products.id` | `set null` | Riwayat pesanan tetap ada walau produk dihapus. |

## Enum `orders.status`

`menunggu_konfirmasi` → `diproses` → `dikirim` → `selesai` (atau `dibatalkan`).

## Catatan

- `order_items` menyimpan **snapshot** `product_name` dan `price` agar nilai transaksi
  historis tidak berubah bila produk diedit.
- Nilai uang disimpan sebagai **integer rupiah** (`bigint`).
- Stok berkurang otomatis saat checkout, dibungkus `DB::transaction()` + `lockForUpdate()`.
