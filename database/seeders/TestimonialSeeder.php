<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            ['name' => 'Rina', 'email' => 'rina@example.com', 'rating' => 5, 'message' => 'Barangnya original, pengiriman cepat. Puas belanja di sini!', 'is_approved' => true],
            ['name' => 'Budi Santoso', 'email' => 'budi@example.com', 'rating' => 4, 'message' => 'Harga bersaing dan packing rapi. Akan order lagi.', 'is_approved' => true],
            ['name' => 'Sari Dewi', 'email' => 'sari@example.com', 'rating' => 5, 'message' => 'Proses pesanan transparan, bisa lacak status dengan kode order.', 'is_approved' => true],
            ['name' => 'Andi', 'email' => 'andi@example.com', 'rating' => 5, 'message' => 'Admin responsif, stok selalu update. Recommended!', 'is_approved' => true],
        ];

        foreach ($testimonials as $data) {
            Testimonial::updateOrCreate(
                ['email' => $data['email'], 'message' => $data['message']],
                $data
            );
        }
    }
}
