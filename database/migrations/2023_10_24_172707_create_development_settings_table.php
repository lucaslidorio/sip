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
        Schema::create('development_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nome_empresa', 45)->nullable(); 
            $table->string('slogam', 45)->nullable(); 
            $table->string('logo_principal', 100)->nullable(); 
            $table->string('logo_secundario', 100)->nullable(); 
            $table->string('site', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('development_settings');
    }
};
