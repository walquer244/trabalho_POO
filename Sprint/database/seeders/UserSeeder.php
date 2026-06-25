<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Administrador
        User::updateOrCreate(
            ['email' => 'admin@sprint.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Funcionário
        User::updateOrCreate(
            ['email' => 'funcionario@sprint.com'],
            [
                'name' => 'Funcionário',
                'password' => Hash::make('func123'),
                'role' => 'funcionario',
            ]
        );
    }
}
