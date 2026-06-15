<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Administrador
        User::updateOrCreate(
            ['email' => 'admin@sprint.com'],
            [
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );

        // Funcionário
        User::updateOrCreate(
            ['email' => 'funcionario@sprint.com'],
            [
                'password' => Hash::make('func123'),
                'role'     => 'funcionario',
            ]
        );
    }
}