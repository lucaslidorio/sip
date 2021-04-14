<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectorTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('director_tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('biennium_legislature_id');
            $table->string('nome')->unique(); 
            $table->string('objetivo')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('biennium_legislature_id')
            ->references('id')
            ->on('biennium_legislatures')
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
        Schema::dropIfExists('director_tables');
    }
}
