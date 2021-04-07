<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LegislatureSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legislature_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('legislature_id');
            $table->string('descricao');
            $table->integer('ano')->unique();           

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('legislature_id')
            ->references('id')
            ->on('legislatures')
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
        Schema::dropIfExists('legislature_sections');
    }
}
