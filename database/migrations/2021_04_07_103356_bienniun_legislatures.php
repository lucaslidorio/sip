<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BienniunLegislatures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biennium_legislatures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('legislature_id');
            $table->string('descricao');             
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->integer('atual');      


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
        Schema::dropIfExists('biennium_legislatures');
    }
}
