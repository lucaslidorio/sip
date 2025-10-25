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
        Schema::create('site_visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->string('page_url')->nullable();
            $table->string('referer')->nullable();
            $table->string('session_id')->nullable();
            $table->timestamp('visited_at');
            $table->timestamps();
            
            // Índices para otimização
            $table->index('ip_address');
            $table->index('session_id');
            $table->index('visited_at');
        });

        // Tabela para contador agregado (mais eficiente para exibição)
        Schema::create('site_visits_counter', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedInteger('visits_count')->default(0);
            $table->unsignedInteger('unique_visitors')->default(0);
            $table->timestamps();
            
            $table->unique('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_visits');
        Schema::dropIfExists('site_visits_counter');
    }
};
