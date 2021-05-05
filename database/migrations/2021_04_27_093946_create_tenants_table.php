<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('endereco');
            $table->char('numero', 6)->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade');
            $table->char('telefone',14)->nullable();
            $table->char('celular',16)->nullable();
            $table->string('dia_atendimento')->nullable();
            $table->char('cnpj',18)->nullable();
            $table->string('email')->nullable();;
            $table->string('facebook')->nullable();;
            $table->string('youtube')->nullable();;
            $table->string('instagram')->nullable();;
            $table->string('twitter')->nullable();;
            $table->string('brasao')->nullable();
            $table->string('bandeira')->nullable();
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
        Schema::dropIfExists('tenants');
    }
}
