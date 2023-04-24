<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentCouncilorSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('present_councilor_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('councilor_id');
            $table->integer('situacao')->nullable();
            $table->timestamps();

            $table->foreign('session_id')
            ->references('id')
            ->on('sessions')
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
        Schema::dropIfExists('present_councilor_sessions');
    }
}
