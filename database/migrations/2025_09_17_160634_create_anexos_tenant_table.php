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
         Schema::create('anexos_tenant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenants_id')->constrained('tenants');
            $table->string('anexo');
            $table->string('nome_original', 255)->nullable();
            $table->integer('tipo_anexo')->comment('1 = Selo de Transparência');
            $table->tinyInteger('situacao')->default(1)->comment('ativo e inativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anexos_tenant');
    }
};
