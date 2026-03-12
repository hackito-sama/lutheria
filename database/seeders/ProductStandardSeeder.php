<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductStandard;

class ProductStandardSeeder extends Seeder
{
    public function run(): void
    {
        // Guitarra Stratocaster
        ProductStandard::create([
            'name' => 'Stratocaster',
            'price' => 350000,
            'images' => json_encode(['strat1.jpg', 'strat2.jpg']),
            'description' => 'Guitarra eléctrica Stratocaster clásica.'
        ]);

        // Guitarra Headless
        ProductStandard::create([
            'name' => 'Guitarra Headless',
            'price' => 350000,
            'images' => json_encode(['headless1.jpg', 'headless2.jpg']),
            'description' => 'Guitarra eléctrica sin cabeza.'
        ]);

        // Bajo Headless
        ProductStandard::create([
            'name' => 'Bajo Headless',
            'price' => 550000,
            'images' => json_encode(['bass_headless1.jpg', 'bass_headless2.jpg']),
            'description' => 'Bajo eléctrico sin cabeza.'
        ]);
    }
}
