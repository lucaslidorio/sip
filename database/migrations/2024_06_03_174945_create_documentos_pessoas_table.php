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
        Schema::create('documentos_pessoas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');          
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('dado_pessoa_id');          
            $table->foreign('dado_pessoa_id')->references('id')->on('dados_pessoas');
            $table->unsignedBigInteger('type_document_id');          
            $table->foreign('type_document_id')->references('id')->on('type_documents');
            $table->string('anexo', 255)->nullable();
            $table->string('nome_original', 255)->nullable(); 
            $table->date('data_validade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_pessoas');
        
    }
};
