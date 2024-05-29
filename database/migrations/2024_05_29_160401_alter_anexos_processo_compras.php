<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('anexos_processo_compras', function (Blueprint $table) {
            $table->after('descricao', function($table){
                $table->integer('qtd_download')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anexos_processo_compras', function (Blueprint $table) {
            $table->dropColumn('qtd_download');
        });
    }
};
