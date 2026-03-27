<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
    {
    // 1. Create the Admin
    \App\Models\User::create([
        'name' => 'System Admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);

    // 2. Create Vendor Users and their Vendor Profiles
    $vendorUser1 = \App\Models\User::create([
        'name' => 'Vendor One User',
        'email' => 'vendor1@example.com',
        'password' => bcrypt('vendor1@example'),
        'role' => 'vendor',
    ]);

    $vendor1 = \App\Models\Vendor::create([
        'user_id' => $vendorUser1->id, // Pass the ID here
        'name' => 'Vendor 1'
    ]);

    $vendorUser2 = \App\Models\User::create([
        'name' => 'Vendor Two User',
        'email' => 'vendor2@example.com',
        'password' => bcrypt('password'),
        'role' => 'vendor',
    ]);

    $vendor2 = \App\Models\Vendor::create([
        'user_id' => $vendorUser2->id, // Pass the ID here
        'name' => 'Vendor 2'
    ]);

    // 3. Create a Regular Customer
    \App\Models\User::create([
        'name' => 'Regular Customer',
        'email' => 'user@example.com',
        'password' => bcrypt('password'),
        'role' => 'customer',
    ]);
	
    // 4. Create Products linked to the Vendor IDs
    \App\Models\Product::create([
        'name' => 'Headphone',
        'price' => 1000,
        'stock' => 10,
        'vendor_id' => $vendor1->id,
        'image' => 'products/headphone.jpg'
    ]);

    \App\Models\Product::create([
        'name' => 'Bluetooth',
        'price' => 2000,
        'stock' => 10,
        'vendor_id' => $vendor2->id,
        'image' => 'products/bluetooth.jpg'
    ]);
    }
}
