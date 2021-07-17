<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegislationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legislations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_legislation_id');
            $table->integer('numero')->nullable();            
            $table->date('data')->nullable();
            $table->string('caput')->nullable();
            $table->text('descricao')->nullable();
            $table->timestamps();

            $table->foreign('type_legislation_id')
            ->references('id')
            ->on('type_legislations')
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
        Schema::dropIfExists('legislations');
    }
}
