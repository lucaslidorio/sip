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
        Schema::create('ouvidorias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipos_ouvidoria');
            $table->unsignedBigInteger('perfil_ouvidoria_id');
            $table->foreign('perfil_ouvidoria_id')->references('id')->on('perfis_ouvidorias');
            $table->unsignedBigInteger('assunto_ouvidoria_id');
            $table->foreign('assunto_ouvidoria_id')->references('id')->on('assuntos_ouvidoria');
            $table->unsignedBigInteger('orgao_ouvidoria_id');
            $table->foreign('orgao_ouvidoria_id')->references('id')->on('orgaos_ouvidoria');
            $table->boolean('anonimo')->default(false);
            $table->boolean('sigiloso')->default(false);            
            $table->string('nome')->nullable();
            $table->char('cpf', 14)->unique()->nullable();
            $table->string('email')->nullable();
            $table->char('telefone', 15)->nullable();
            $table->char('celular', 15)->nullable();
            $table->string('endereco')->nullable();
            $table->char('mumero_endereco', 6)->nullable();
            $table->string('bairro')->nullable();
            $table->string('municipio')->nullable();
            $table->char('uf', 2)->nullable();
            $table->char('cep', 10)->nullable();
            $table->string('complemento')->nullable();
            $table->integer('genero')->nullable();
            $table->integer('idade')->nullable();
            $table->integer('quant_filhos')->nullable();
            $table->integer('ocupacao')->nullable();
            $table->text('manifestacao')->nullable();
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
        Schema::dropIfExists('ouvidorias');
    }
};
