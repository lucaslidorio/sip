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
        Schema::create('alternativas_pesquisa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pergunta_pesquisa_id')->constrained('perguntas_pesquisa')->onDelete('cascade');
            $table->string('alternativa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternativas_pesquisa');
    }
};
