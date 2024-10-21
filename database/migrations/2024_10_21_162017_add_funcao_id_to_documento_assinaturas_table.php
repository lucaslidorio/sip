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
        Schema::table('documento_assinaturas', function (Blueprint $table) {
                 // Adiciona a coluna funcao_id logo após user_id
                 $table->unsignedBigInteger('funcao_id')->nullable()->after('user_id');
                 // Cria a chave estrangeira, assumindo que 'users_functions' é o nome da tabela relacionada
                 $table->foreign('funcao_id')->references('id')->on('functions')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documento_assinaturas', function (Blueprint $table) {
           // Remove a chave estrangeira e o campo funcao_id
           $table->dropForeign(['funcao_id']);
           $table->dropColumn('funcao_id');
        });
    }
};
