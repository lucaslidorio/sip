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
        Schema::create('documento_assinaturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('documento_dof_id');
            $table->unsignedBigInteger('user_id');
            $table->string('assinatura'); // Hash gerado a partir do documento
            $table->string('documento_hash'); // Hash do conteúdo no momento da assinatura
            $table->timestamp('data_assinatura'); // Data e hora da assinatura
            $table->string('codigo_verificacao')->unique(); // Código único de verificação
            $table->timestamps();

            $table->foreign('documento_dof_id')->references('id')->on('documentos_dof')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documento_assinaturas');
    }
};
