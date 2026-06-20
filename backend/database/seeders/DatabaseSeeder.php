<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Brands
        $toyota = \App\Models\VehicleBrand::create(['name' => 'Toyota']);
        $honda = \App\Models\VehicleBrand::create(['name' => 'Honda']);
        $suzuki = \App\Models\VehicleBrand::create(['name' => 'Suzuki']);
        $mitsubishi = \App\Models\VehicleBrand::create(['name' => 'Mitsubishi']);
        $daihatsu = \App\Models\VehicleBrand::create(['name' => 'Daihatsu']);

        // 2. Seed Users
        $admin = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password', // hashed by User model casts in Laravel 10 (or Hash::make if we want to be safe)
            'phone' => '081234567890',
            'role' => 'admin',
            'is_active' => true,
        ]);

        $user = \App\Models\User::create([
            'name' => 'Andi Pratama',
            'email' => 'andi@email.com',
            'password' => 'password',
            'phone' => '082234567890',
            'role' => 'user',
            'is_active' => true,
        ]);

        $seller = \App\Models\User::create([
            'name' => 'Showroom Maju Motor',
            'email' => 'seller@example.com',
            'password' => 'password',
            'phone' => '083234567890',
            'role' => 'seller',
            'is_active' => true,
        ]);

        $rental = \App\Models\User::create([
            'name' => 'Sewa Mobil Nusantara',
            'email' => 'rental@example.com',
            'password' => 'password',
            'phone' => '084234567890',
            'role' => 'rental',
            'is_active' => true,
        ]);

        // 3. Seed Vehicles
        $vehicle1 = \App\Models\Vehicle::create([
            'owner_id' => $seller->id,
            'brand_id' => $toyota->id,
            'title' => 'Toyota Avanza Veloz 1.5 AT 2021',
            'category' => 'mobil',
            'transaction_type' => 'jual',
            'price' => 185000000,
            'year' => 2021,
            'color' => 'Hitam',
            'transmission' => 'otomatis',
            'fuel_type' => 'bensin',
            'mileage' => 45000,
            'location' => 'Jakarta',
            'description' => 'Toyota Avanza Veloz 2021 mulus, satu tangan dari baru, servis record resmi Toyota.',
            'status' => 'available',
            'thumbnail' => 'assets/images/placeholder_avanza.png',
        ]);

        $vehicle2 = \App\Models\Vehicle::create([
            'owner_id' => $rental->id,
            'brand_id' => $honda->id,
            'title' => 'Honda Brio Satya 1.2 MT 2022',
            'category' => 'mobil',
            'transaction_type' => 'sewa',
            'rental_price_daily' => 350000,
            'rental_price_weekly' => 2200000,
            'rental_price_monthly' => 7500000,
            'year' => 2022,
            'color' => 'Merah',
            'transmission' => 'manual',
            'fuel_type' => 'bensin',
            'mileage' => 28000,
            'location' => 'Surabaya',
            'description' => 'Honda Brio Satya 2022 irit bensin, mesin prima, AC dingin. Siap disewakan harian/mingguan/bulanan.',
            'status' => 'available',
            'thumbnail' => 'assets/images/placeholder_brio.png',
        ]);
    }
}
