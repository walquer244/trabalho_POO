<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Adiciona a coluna 'ano' às tabelas carros e motos se ainda não existir.
     * O sistema foi projetado para usar este campo mas o banco original não o tinha.
     */
    public function up(): void
    {
        // Adiciona coluna 'ano' na tabela carros (se não existir)
        if (Schema::hasTable('carros') && !Schema::hasColumn('carros', 'ano')) {
            Schema::table('carros', function (Blueprint $table) {
                $table->smallInteger('ano')->unsigned()->nullable()->after('modelo');
            });
        }

        // Adiciona coluna 'ano' na tabela motos (se não existir)
        if (Schema::hasTable('motos') && !Schema::hasColumn('motos', 'ano')) {
            Schema::table('motos', function (Blueprint $table) {
                $table->smallInteger('ano')->unsigned()->nullable()->after('modelo');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('carros', 'ano')) {
            Schema::table('carros', function (Blueprint $table) {
                $table->dropColumn('ano');
            });
        }

        if (Schema::hasColumn('motos', 'ano')) {
            Schema::table('motos', function (Blueprint $table) {
                $table->dropColumn('ano');
            });
        }
    }
};
