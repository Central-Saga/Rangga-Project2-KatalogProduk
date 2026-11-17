<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@katalog.test'],
            [
                'name' => 'Admin Katalog',
                'password' => Hash::make('password'),
            ]
        );

        // is_admin sengaja tidak mass-assignable; set eksplisit lewat forceFill.
        $admin->forceFill(['is_admin' => true])->save();

        $customer = User::updateOrCreate(
            ['email' => 'pelanggan@katalog.test'],
            [
                'name' => 'Pelanggan Demo',
                'password' => Hash::make('password'),
            ]
        );

        $customer->forceFill(['is_admin' => false])->save();
    }
}
