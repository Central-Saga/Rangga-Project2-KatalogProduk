<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@katalog.test'],
            [
                'name' => 'Admin Katalog',
                'password' => Hash::make('password'),
            ]
        );
    }
}
