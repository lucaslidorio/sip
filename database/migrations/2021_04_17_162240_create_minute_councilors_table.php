<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinuteCouncilorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minute_councilors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('minute_id');
            $table->unsignedBigInteger('councilor_id');
           

            $table->foreign('minute_id')
            ->references('id')
            ->on('minutes')
            ->onDelete('cascade')
            ->onUpdate('cascade');            

            $table->foreign('councilor_id')
            ->references('id')
            ->on('councilors')
            ->onDelete('cascade')
            ->onUpdate('cascade');

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
        Schema::dropIfExists('minute_councilors');
    }
}
