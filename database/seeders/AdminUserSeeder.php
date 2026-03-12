<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin1',
            'email' => 'admin1@example.com',
            'phone' => '1111111111',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'admin2',
            'email' => 'admin2@example.com',
            'phone' => '2222222222',
            'password' => Hash::make('12345678'),
        ]);
    }
}
