<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik', 'slug' => 'elektronik', 'description' => 'Perangkat dan gadget elektronik.'],
            ['name' => 'Fashion Pria', 'slug' => 'fashion-pria', 'description' => 'Pakaian dan aksesori pria.'],
            ['name' => 'Fashion Wanita', 'slug' => 'fashion-wanita', 'description' => 'Pakaian dan aksesori wanita.'],
            ['name' => 'Perlengkapan Rumah', 'slug' => 'perlengkapan-rumah', 'description' => 'Kebutuhan rumah tangga.'],
            ['name' => 'Olahraga', 'slug' => 'olahraga', 'description' => 'Perlengkapan olahraga dan outdoor.'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
