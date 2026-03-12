<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PickupSeeder extends Seeder
{
    public function run(): void
    {
        // Pickups para Stratocaster
        DB::table('pickups')->insert([
            ['name' => 'Single Coil', 'value' => 'single', 'product_type' => 'stratocaster'],
            ['name' => 'Single-Single', 'value' => 'single-single', 'product_type' => 'stratocaster'],
            ['name' => 'Humbucker', 'value' => 'humbucker', 'product_type' => 'stratocaster'],
        ]);

        // Pickups para Guitarra Headless
        DB::table('pickups')->insert([
            ['name' => 'Humbucker', 'value' => 'humbucker', 'product_type' => 'headless_guitar'],
            ['name' => 'Single-Humbucker', 'value' => 'single-humbucker', 'product_type' => 'headless_guitar'],
        ]);

        // Pickups para Bajo Headless
        DB::table('pickups')->insert([
            ['name' => 'Humbucker', 'value' => 'humbucker', 'product_type' => 'headless_bass'],
            ['name' => 'Soapbar', 'value' => 'soapbar', 'product_type' => 'headless_bass'],
        ]);
    }
}
