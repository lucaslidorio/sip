<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LegislativePeriods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legislative_periods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('legislature_section_id');
            $table->string('descricao');
            $table->integer('ano');           

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('legislature_section_id')
            ->references('id')
            ->on('legislature_sections')
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
        Schema::dropIfExists('legislative_periods');
    }
}
