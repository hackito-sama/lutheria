<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        // Colores para Guitarra Headless
        DB::table('colors')->insert([
            [
                'name' => 'Cherry',
                'value' => 'cherry',
                'product_type' => 'headless_guitar',
                'images' => json_encode(
                    [
                        "https://i.ibb.co/jvZ05xhR/1.png",
                        "https://i.ibb.co/XkNcjq8W/2.png",
                        "https://i.ibb.co/q3RSjqcz/3.png",
                        "https://i.ibb.co/vCYHDBLQ/4.png"
                    ]
                )
            ],
            [
                'name' => 'Purple',
                'value' => 'purple',
                'product_type' => 'headless_guitar',
                'images' => json_encode(
                    [
                        "https://i.ibb.co/rGgvB3Dp/1.png",
                        "https://i.ibb.co/TBM8rgJ6/2.png",
                        "https://i.ibb.co/j9F89mwJ/3.png",
                        "https://i.ibb.co/Zp1L8jVB/4.png"
                    ]
                ),
            ],
            [
                'name' => 'Sin color',
                'value' => 'stock',
                'product_type' => 'headless_guitar',
                'images' => json_encode(
                    [
                        "https://i.ibb.co/SDSV11kb/1.png",
                        "https://i.ibb.co/TxWNtjBH/2.png",
                        "https://i.ibb.co/n8QYbMbS/3.png",
                        "https://i.ibb.co/n8QYbMbS/3.png"
                    ]
                ),
            ],
            [
                'name' => 'Amarillo Transparente',
                'value' => 'yellow',
                'product_type' => 'headless_guitar',
                'images' => json_encode(
                    [
                        "https://i.ibb.co/8n26Fr8D/1.png",
                        "https://i.ibb.co/8gxR6Zz6/2.png",
                        "https://i.ibb.co/jkCJDd3s/3.png",
                        "https://i.ibb.co/5WVJSssS/4.png"
                    ]
                ),
            ]
        ]);

    }
}
