<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SetupController extends Controller
{
    public function run()
    {
        $success = false;
        $message = '';

        try {
            $schemaPath = database_path('schema.sql');

            if (!file_exists($schemaPath)) {
                throw new \Exception("Arquivo de schema não encontrado em: " . $schemaPath);
            }

            $sql = file_get_contents($schemaPath);
            DB::unprepared($sql);
            $message .= "Estrutura do banco de dados inicializada com sucesso!<br>";

            DB::table('carros')->truncate();
            DB::table('motos')->truncate();
            DB::table('funcionarios')->truncate();
            DB::table('usuarios')->truncate();

            $users = [
                [
                    'nome'         => 'Administrador Honda',
                    'email'        => 'admin@honda.com.br',
                    'senha'        => password_hash('admin123', PASSWORD_DEFAULT),
                    'nivel_acesso' => 'admin',
                ],
                [
                    'nome'         => 'Felipe Vendedor',
                    'email'        => 'vendedor@honda.com.br',
                    'senha'        => password_hash('venda123', PASSWORD_DEFAULT),
                    'nivel_acesso' => 'funcionario',
                ],
            ];

            DB::table('usuarios')->insert($users);

            $message .= "Usuários administrativos criados com sucesso (admin@honda.com.br / admin123 e vendedor@honda.com.br / venda123).<br>";
            $message .= "Estoque de veículos e quadro de funcionários limpos para preenchimento manual.<br>";

            $success = true;

        } catch (\Exception $e) {
            $message .= "Erro ao rodar setup: " . $e->getMessage();
        }

        return view('setup', compact('success', 'message'));
    }
}
