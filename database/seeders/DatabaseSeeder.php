<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Orden recomendado: primero datos base como colores, luego productos y opciones, finalmente pickups u otros datos dependientes
        $this->call([
            ColorSeeder::class,
            ProductStandardSeeder::class,
            ProductOptionsSeeder::class,
            PickupSeeder::class,
        ]);
    }
}
