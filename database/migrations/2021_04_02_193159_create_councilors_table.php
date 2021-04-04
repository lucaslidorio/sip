<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouncilorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('councilors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('party_id');
            $table->string('nome')->unique();
            $table->string('nome_parlamentar')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->char('cpf', 14)->unique()->nullable();
            $table->string('estado_civil');
            $table->string('naturalidade')->nullable();
            $table->string('ocupacao_profissional')->nullable();
            $table->string('escolaridade')->nullable();
            $table->char('telefone', 15)->nullable();
            $table->char('telefone_gabinete', 15)->nullable();            
            $table->string('endereco')->nullable();
            $table->string('endereco_gabinete')->nullable();
            $table->string('email')->nullable();
            $table->string('img')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->text('biografia')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('party_id')
                ->references('id')
                ->on('parties')
                ->onDelete('cascade')
                ->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('councilors');
    }
}
