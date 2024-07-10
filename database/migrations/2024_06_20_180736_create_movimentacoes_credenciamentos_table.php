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
        Schema::create('movimentacoes_credenciamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');          
            $table->foreign('user_id')->references('id')->on('users');          
            $table->unsignedBigInteger('credenciamento_compra_id');          
            $table->foreign('credenciamento_compra_id')->references('id')->on('credenciamentos_processos_compras');
            $table->unsignedBigInteger('tipo_movimentacao_id');          
            $table->foreign('tipo_movimentacao_id')->references('id')->on('tipos_movimentacoes_credenciamentos');
            $table->string('observacao', 255)->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacoes_credenciamentos');
    }
};
