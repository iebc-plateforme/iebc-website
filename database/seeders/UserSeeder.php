<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer le Super Admin
        User::updateOrCreate(
            ['email' => 'ismailahamadou5@gmail.com'],
            [
                'name' => 'ISMAILA HAMADOUA',
                'last_name' => '',
                'email' => 'ismailahamadou5@gmail.com',
                'password' => '12345678',
                'role' => 'superadmin',
                'email_verified_at' => now(),
            ]
        );
    }
}