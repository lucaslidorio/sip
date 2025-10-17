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
        Schema::create('configuracao_ouvidorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome_responsavel')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone', 16)->nullable();
            $table->string('celular', 16)->nullable();
            $table->string('endereco_fisico')->nullable();
            $table->string('dias_atendimento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracao_ouvidorias');
    }
};
