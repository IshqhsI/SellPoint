<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@admin.com'], // Kondisi pencarian
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );
    }
}
