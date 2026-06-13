<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Cria a tabela 'funcionarios' com a estrutura real do sistema Honda.
     * Estrutura: id, nome, funcao, data_admissao, data_nascimento, salario, data_cadastro
     */
    public function up(): void
    {
        if (!Schema::hasTable('funcionarios')) {
            Schema::create('funcionarios', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome', 100);
                $table->string('funcao', 100);
                $table->date('data_admissao');
                $table->date('data_nascimento');
                $table->decimal('salario', 10, 2);
                $table->timestamp('data_cadastro')->useCurrent();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};
