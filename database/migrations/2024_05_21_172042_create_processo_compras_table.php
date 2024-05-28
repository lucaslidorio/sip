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
        Schema::create('processo_compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('modalidade_id');          
            $table->foreign('modalidade_id')->references('id')->on('modalidades');            
            $table->unsignedBigInteger('proceeding_situation_id');                    
            $table->foreign('proceeding_situation_id')->references('id')->on('proceeding_situation');
            $table->unsignedBigInteger('criterio_julgamento_id');          
            $table->foreign('criterio_julgamento_id')->references('id')->on('criterios_julgamento');
            $table->integer('numero')->nullable();
            $table->text('objeto')->nullable();
            $table->text('descricao')->nullable();
            $table->dateTime('data_publicacao');
            $table->dateTime('inicio_sessao')->nullable();
            $table->integer('qtd_lotes')->nullable();
            $table->unsignedBigInteger('user_created');          
            $table->foreign('user_created')->references('id')->on('users'); 
            $table->unsignedBigInteger('user_last_updated')->nullable();          
            $table->foreign('user_last_updated')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processo_compras');
    }
};
