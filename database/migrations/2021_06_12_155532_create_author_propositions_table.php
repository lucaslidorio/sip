<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorPropositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_propositions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposition_id');
            $table->unsignedBigInteger('councilor_id');
            $table->timestamps();

            $table->foreign('proposition_id')
            ->references('id')
            ->on('propositions')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('councilor_id')
            ->references('id')
            ->on('councilors')
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
        Schema::dropIfExists('author_propositions');
    }
}
