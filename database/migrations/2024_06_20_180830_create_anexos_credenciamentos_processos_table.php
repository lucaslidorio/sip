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
        Schema::create('anexos_credenciamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credenciamento_compra_id');          
            $table->foreign('credenciamento_compra_id')->references('id')->on('credenciamentos_processos_compras')->onDelete('cascade');
            $table->unsignedBigInteger('type_document_id')->nullable();          
            $table->foreign('type_document_id')->references('id')->on('type_documents');
            $table->string('anexo', 255)->nullable();
            $table->string('nome_original', 255)->nullable();   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anexos_credenciamentos_processos');
    }
};
