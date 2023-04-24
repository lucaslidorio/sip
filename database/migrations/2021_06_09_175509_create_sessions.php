<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('type_session_id');
            $table->unsignedBigInteger('legislature_id');
            $table->unsignedBigInteger('legislature_section_id');
            $table->unsignedBigInteger('period_id');
            $table->string('nome')->nullable();
            $table->date('data')->nullable();
            $table->time('hora');            
            $table->text('descricao')->nullable();
            $table->timestamps();


            $table->foreign('type_session_id')
                    ->references('id')
                    ->on('type_sessions')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('legislature_id')
                    ->references('id')
                    ->on('legislatures')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('legislature_section_id')
                    ->references('id')
                    ->on('legislature_sections')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        $table->foreign('period_id')
                    ->references('id')
                    ->on('periods')
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
        Schema::dropIfExists('sessions');
    }
}
