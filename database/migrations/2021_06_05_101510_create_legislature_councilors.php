<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegislatureCouncilors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legislature_councilors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('legislature_id'); 
            $table->unsignedBigInteger('councilor_id');  
            $table->integer('qtd_votos')->nullable();          
            $table->integer('situacao');
            $table->timestamps();
            

            $table->foreign('legislature_id')
            ->references('id')
            ->on('legislatures')
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
        Schema::dropIfExists('legislature_councilors');
    }
}
