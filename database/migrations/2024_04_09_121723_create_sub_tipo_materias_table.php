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
        Schema::create('sub_tipo_materias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_materia_id');
            $table->string('nome', 255);
            $table->boolean('situacao');
            $table->timestamps();

            $table->foreign('tipo_materia_id')
                    ->references('id')
                    ->on('tipo_materias')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_tipo_materias');
    }
};
