<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propositions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proceeding_situation_id');
            $table->unsignedBigInteger('type_proposition_id');
            $table->integer('numero')->nullable();
            $table->date('data')->nullable();
            $table->string('descricao')->nullable();
            $table->timestamps();


            $table->foreign('proceeding_situation_id')
            ->references('id')
            ->on('proceeding_situation')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('type_proposition_id')
            ->references('id')
            ->on('type_propositions')
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
        Schema::dropIfExists('propositions');
    }
}
