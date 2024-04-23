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
        Schema::create('voto_vereador_proposituras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposition_id');          
            $table->foreign('proposition_id')->references('id')->on('propositions');
            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->unsignedBigInteger('councilor_id');
            $table->foreign('councilor_id')->references('id')->on('councilors');
            $table->unsignedBigInteger('tipo_voto_id');
            $table->foreign('tipo_voto_id')->references('id')->on('tipo_votos');

        });
    }

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voto_vereador_proposituras');
    }
};
