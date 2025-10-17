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
        Schema::create('pronunciamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('councilor_id')->constrained('councilors');
            $table->foreignId('session_id')->constrained('sessions');            
            $table->longText('discurso')->nullable();
            $table->string('link_video', length:100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pronunciamentos');
    }
};
