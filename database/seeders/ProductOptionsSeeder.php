<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductStandard;
use App\Models\ProductOption;

class ProductOptionsSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener los productos
        $stratocaster = ProductStandard::where('name', 'Stratocaster')->first();
        $headlessGuitar = ProductStandard::where('name', 'Guitarra Headless')->first();
        $headlessBass = ProductStandard::where('name', 'Bajo Headless')->first();

        // Opciones para Stratocaster
        ProductOption::create([
            'product_standard_id' => $stratocaster->id,
            'type' => 'pickup',
            'options' => ['single', 'single-single', 'humbucker']
        ]);
        ProductOption::create([
            'product_standard_id' => $stratocaster->id,
            'type' => 'color',
            'options' => ['red', 'sunburst', 'black']
        ]);

        // Opciones para Guitarra Headless
        ProductOption::create([
            'product_standard_id' => $headlessGuitar->id,
            'type' => 'pickup',
            'options' => ['humbucker', 'single-humbucker']
        ]);
        ProductOption::create([
            'product_standard_id' => $headlessGuitar->id,
            'type' => 'color',
            'options' => ['black', 'white', 'blue']
        ]);

        // Opciones para Bajo Headless
        ProductOption::create([
            'product_standard_id' => $headlessBass->id,
            'type' => 'pickup',
            'options' => ['humbucker', 'soapbar']
        ]);
        ProductOption::create([
            'product_standard_id' => $headlessBass->id,
            'type' => 'color',
            'options' => ['black', 'natural']
        ]);
    }
}
