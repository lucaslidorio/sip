<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecretariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secretaries', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->char('sigla',10)->nullable();
            $table->string('nome_responsavel')->nullable();
            $table->char('telefone',12)->nullable();
            $table->char('celular',12)->nullable();           
            $table->string('endereco')->nullable();
            $table->string('email')->nullable();
            $table->integer('situacao');
            $table->text('sobre')->nullable();
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
        Schema::dropIfExists('secretaries');
    }
}
