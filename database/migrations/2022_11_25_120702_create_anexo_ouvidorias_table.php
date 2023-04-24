<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anexos_ouvidoria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ouvidoria_id');
            $table->foreign('ouvidoria_id')->references('id')->on('ouvidorias');
            $table->string('anexo')->nullable();
            $table->string('nome_original')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anexos_ouvidoria');
    }
};
