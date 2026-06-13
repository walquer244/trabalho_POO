<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Cria a tabela 'usuarios' com a estrutura real do sistema Honda.
     * Estrutura: id, nome, email, senha, nivel_acesso, data_cadastro
     */
    public function up(): void
    {
        if (!Schema::hasTable('usuarios')) {
            Schema::create('usuarios', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome', 100);
                $table->string('email', 150)->unique();
                $table->string('senha', 255);
                $table->enum('nivel_acesso', ['admin', 'funcionario'])->default('funcionario');
                $table->timestamp('data_cadastro')->useCurrent();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
