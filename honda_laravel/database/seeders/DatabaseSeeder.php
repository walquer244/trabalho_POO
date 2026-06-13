<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Cria usuário admin padrão e dados de exemplo para o sistema Honda.
     * Usa INSERT IGNORE para não falhar se os dados já existirem.
     */
    public function run(): void
    {
        // ── Usuários ─────────────────────────────────────────────────
        // Admin:      admin@honda.com.br  / admin123
        // Funcionário: funcionario@honda.com.br / honda123
        DB::table('usuarios')->insertOrIgnore([
            [
                'nome'         => 'Administrador',
                'email'        => 'admin@honda.com.br',
                'senha'        => Hash::make('admin123'),
                'nivel_acesso' => 'admin',
            ],
            [
                'nome'         => 'Funcionário Demo',
                'email'        => 'funcionario@honda.com.br',
                'senha'        => Hash::make('honda123'),
                'nivel_acesso' => 'funcionario',
            ],
        ]);

        // ── Funcionários de exemplo ───────────────────────────────────
        DB::table('funcionarios')->insertOrIgnore([
            [
                'nome'            => 'Carlos Mendes',
                'funcao'          => 'Vendedor',
                'data_admissao'   => '2022-03-15',
                'data_nascimento' => '1990-06-20',
                'salario'         => 3500.00,
            ],
            [
                'nome'            => 'Ana Paula Ramos',
                'funcao'          => 'Gerente de Vendas',
                'data_admissao'   => '2020-01-10',
                'data_nascimento' => '1985-11-05',
                'salario'         => 6200.00,
            ],
            [
                'nome'            => 'Lucas Ferreira',
                'funcao'          => 'Mecânico',
                'data_admissao'   => '2021-07-20',
                'data_nascimento' => '1993-03-14',
                'salario'         => 4100.00,
            ],
        ]);

        // ── Carros de exemplo ─────────────────────────────────────────
        // Estrutura real: marca, modelo, quilometragem, valor, cor
        DB::table('carros')->insertOrIgnore([
            ['marca' => 'Honda', 'modelo' => 'Civic EXL',   'ano' => 2023, 'quilometragem' => 5000,  'valor' => 155000.00, 'cor' => 'Branco'],
            ['marca' => 'Honda', 'modelo' => 'HR-V EX',     'ano' => 2022, 'quilometragem' => 18000, 'valor' => 140000.00, 'cor' => 'Prata'],
            ['marca' => 'Honda', 'modelo' => 'WR-V',        'ano' => 2024, 'quilometragem' => 0,     'valor' => 115000.00, 'cor' => 'Preto'],
            ['marca' => 'Honda', 'modelo' => 'City Hatch',  'ano' => 2023, 'quilometragem' => 8000,  'valor' => 120000.00, 'cor' => 'Azul'],
            ['marca' => 'Honda', 'modelo' => 'CR-V Touring','ano' => 2022, 'quilometragem' => 22000, 'valor' => 230000.00, 'cor' => 'Cinza'],
            ['marca' => 'Honda', 'modelo' => 'Fit EX',      'ano' => 2021, 'quilometragem' => 32000, 'valor' => 95000.00,  'cor' => 'Vermelho'],
        ]);

        // ── Motos de exemplo ──────────────────────────────────────────
        // Estrutura real: marca, modelo, quilometragem, valor, cor
        DB::table('motos')->insertOrIgnore([
            ['marca' => 'Honda', 'modelo' => 'CB 300R', 'ano' => 2023, 'quilometragem' => 2000,  'valor' => 24500.00, 'cor' => 'Preto'],
            ['marca' => 'Honda', 'modelo' => 'CG 160',  'ano' => 2022, 'quilometragem' => 15000, 'valor' => 13800.00, 'cor' => 'Vermelho'],
            ['marca' => 'Honda', 'modelo' => 'XRE 300', 'ano' => 2023, 'quilometragem' => 5500,  'valor' => 28000.00, 'cor' => 'Branco'],
            ['marca' => 'Honda', 'modelo' => 'PCX 160', 'ano' => 2024, 'quilometragem' => 0,     'valor' => 19900.00, 'cor' => 'Prata'],
            ['marca' => 'Honda', 'modelo' => 'CB 500F', 'ano' => 2022, 'quilometragem' => 9000,  'valor' => 37000.00, 'cor' => 'Laranja'],
            ['marca' => 'Honda', 'modelo' => 'NXR 160', 'ano' => 2023, 'quilometragem' => 3000,  'valor' => 17500.00, 'cor' => 'Azul'],
        ]);

        $this->command->info('✅ Seed concluído!');
        $this->command->info('   Admin:       admin@honda.com.br / admin123');
        $this->command->info('   Funcionário: funcionario@honda.com.br / honda123');
    }
}
