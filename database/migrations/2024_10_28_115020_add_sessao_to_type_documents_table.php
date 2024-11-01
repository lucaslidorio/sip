<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('type_documents', function (Blueprint $table) {
            $table->boolean('sessao')
            ->default(0)
            ->comment("Quando marcado com 1, aparece nos anexos de sessões")
            ->after('legislacao');
        });
        $nomesParaSessao = [
            'Ata',
            'Ordem do dia',
            'Edital de Convocação',
            'Indicação',
            'Aviso',
            'Parecer',
            'Regimento Interno',
        ];

        // Atualiza os registros existentes
        DB::table('type_documents')
            ->whereIn('nome', $nomesParaSessao)
            ->update(['sessao' => 1]);

        // Define o valor 0 para os demais registros (caso não tenham sido definidos)
        DB::table('type_documents')
            ->whereNotIn('nome', $nomesParaSessao)
            ->update(['sessao' => 0]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('type_documents', function (Blueprint $table) {
            $table->dropColumn("sessao");
        });
    }
};
