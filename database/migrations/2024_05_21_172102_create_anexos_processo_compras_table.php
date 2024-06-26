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
        Schema::create('anexos_processo_compras', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger('processo_compra_id');
            $table->foreign('processo_compra_id')
            ->references('id')->on('processo_compras');
            $table->unsignedBigInteger('type_document_id')->nullable();
            $table->foreign('type_document_id')
            ->references('id')->on('type_documents');
            $table->string('anexo', 255)->nullable();
            $table->string('nome', 255)->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anexos_processo_compras');
    }
};
