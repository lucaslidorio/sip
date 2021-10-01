<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeemCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seem_commissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commission_id');
            $table->unsignedBigInteger('proposition_id');
            $table->date('data')->nullable();
            $table->string('autoria')->nullable();
            $table->string('assunto');
            $table->text('descricao');
            $table->timestamps();

            $table->foreign('commission_id')
            ->references('id')
            ->on('commissions')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('proposition_id')
            ->references('id')
            ->on('propositions')
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
        Schema::dropIfExists('seem_commissions');
    }
}
