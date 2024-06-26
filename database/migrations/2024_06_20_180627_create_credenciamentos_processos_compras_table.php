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
        Schema::create('credenciamentos_processos_compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dado_pessoa_id');                  
            $table->foreign('dado_pessoa_id')->references('id')->on('dados_pessoas');
            $table->unsignedBigInteger('user_id');          
            $table->foreign('user_id')->references('id')->on('users'); 

            $table->unsignedBigInteger('processo_compra_id');          
            $table->foreign('processo_compra_id')->references('id')->on('processo_compras');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credenciamentos_processos_compras');
    }
};
