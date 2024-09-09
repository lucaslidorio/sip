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
        Schema::create('documentos_dof', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_id_last_update')->nullable();
            $table->unsignedBigInteger('tipo_materia_id');
            $table->unsignedBigInteger('sub_tipo_materia_id');
            $table->string('titulo');  // Campo para o título do documento
            $table->uuid('uuid');      // Campo para o UUID do documento
            $table->text('conteudo')->nullable();     
            $table->date('data_publicacao')->nullable();     

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('tipo_materia_id')
                    ->references('id')
                    ->on('tipo_materias')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('sub_tipo_materia_id')
                    ->references('id')
                    ->on('sub_tipo_materias')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_dofs');
    }
};
