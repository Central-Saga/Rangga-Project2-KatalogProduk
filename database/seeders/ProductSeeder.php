<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['category' => 'elektronik', 'name' => 'Smartphone X200 8/256GB', 'price' => 4299000, 'stock' => 12, 'description' => 'Smartphone layar AMOLED 6.7 inci, kamera 108MP, baterai 5000mAh.'],
            ['category' => 'elektronik', 'name' => 'TWS Earbuds Pro', 'price' => 359000, 'stock' => 40, 'description' => 'Earbuds nirkabel dengan active noise cancelling dan baterai 30 jam.'],
            ['category' => 'elektronik', 'name' => 'Power Bank 20000mAh', 'price' => 225000, 'stock' => 25, 'description' => 'Power bank fast charging 22.5W, dua output USB dan USB-C.'],
            ['category' => 'elektronik', 'name' => 'Keyboard Mekanik 68 Keys', 'price' => 450000, 'stock' => 18, 'description' => 'Keyboard mekanik hot-swappable, RGB, koneksi wireless.'],

            ['category' => 'fashion-pria', 'name' => 'Kemeja Flanel Lengan Panjang', 'price' => 179000, 'stock' => 30, 'description' => 'Kemeja flanel katun premium, nyaman untuk harian.'],
            ['category' => 'fashion-pria', 'name' => 'Sepatu Sneakers Canvas', 'price' => 269000, 'stock' => 22, 'description' => 'Sneakers canvas unisex dengan sol karet anti slip.'],
            ['category' => 'fashion-pria', 'name' => 'Tas Ransel Anti Air 25L', 'price' => 215000, 'stock' => 15, 'description' => 'Ransel laptop 15 inci dengan bahan anti air.'],

            ['category' => 'fashion-wanita', 'name' => 'Dress Midi Katun', 'price' => 199000, 'stock' => 20, 'description' => 'Dress midi bahan katun adem, cocok untuk acara santai.'],
            ['category' => 'fashion-wanita', 'name' => 'Tas Selempang Mini', 'price' => 149000, 'stock' => 35, 'description' => 'Tas selempang mini dengan tali adjustable.'],
            ['category' => 'fashion-wanita', 'name' => 'Hijab Voal Premium', 'price' => 89000, 'stock' => 50, 'description' => 'Hijab voal premium tidak mudah kusut, berbagai warna.'],

            ['category' => 'perlengkapan-rumah', 'name' => 'Blender Portable 400ml', 'price' => 185000, 'stock' => 28, 'description' => 'Blender portable USB rechargeable untuk jus dan smoothie.'],
            ['category' => 'perlengkapan-rumah', 'name' => 'Lampu Meja LED Touch', 'price' => 99000, 'stock' => 40, 'description' => 'Lampu meja LED dengan kontrol sentuh dan 3 tingkat kecerahan.'],
            ['category' => 'perlengkapan-rumah', 'name' => 'Rak Buku Minimalis 3 Tingkat', 'price' => 259000, 'stock' => 10, 'description' => 'Rak buku kayu minimalis, mudah dirakit.'],

            ['category' => 'olahraga', 'name' => 'Matras Yoga Anti Slip', 'price' => 129000, 'stock' => 26, 'description' => 'Matras yoga tebal 8mm, anti slip, mudah dibawa.'],
            ['category' => 'olahraga', 'name' => 'Dumbbell Set 10kg', 'price' => 349000, 'stock' => 9, 'description' => 'Set dumbbell adjustable total 10kg untuk latihan di rumah.'],
            ['category' => 'olahraga', 'name' => 'Botol Minum Sport 1L', 'price' => 75000, 'stock' => 60, 'description' => 'Botol minum sport BPA-free dengan tutup flip.'],
        ];

        foreach ($products as $data) {
            $category = Category::where('slug', $data['category'])->first();

            if (! $category) {
                continue;
            }

            Product::updateOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'category_id' => $category->id,
                    'name' => $data['name'],
                    'slug' => Str::slug($data['name']),
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'stock' => $data['stock'],
                    'is_active' => true,
                ]
            );
        }
    }
}
