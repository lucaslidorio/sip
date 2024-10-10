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
        Schema::create('user_functions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('function_id');
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->string('legislacao', 45)->nullable();
            $table->tinyInteger('situacao')->nullable();
            $table->timestamps();

             // Foreign keys
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
             $table->foreign('function_id')->references('id')->on('functions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_functions');
    }
};
