<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Cria a tabela 'motos' com a estrutura real do sistema Honda.
     * Estrutura: id, marca, modelo, quilometragem, valor, cor, data_cadastro
     */
    public function up(): void
    {
        if (!Schema::hasTable('motos')) {
            Schema::create('motos', function (Blueprint $table) {
                $table->increments('id');
                $table->string('marca', 80);
                $table->string('modelo', 80);
                $table->integer('quilometragem')->default(0);
                $table->decimal('valor', 12, 2);
                $table->string('cor', 50);
                $table->timestamp('data_cadastro')->useCurrent();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motos');
    }
};
