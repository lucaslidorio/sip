<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minutes', function (Blueprint $table) {
            $table->id();            
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('type_minute_id'); 
            $table->unsignedBigInteger('legislature_id'); 
            $table->unsignedBigInteger('legislature_section_id'); 
            $table->unsignedBigInteger('legislative_period_id'); 

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreign('type_minute_id')
            ->references('id')
            ->on('type_minutes')
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

            $table->foreign('legislative_period_id')
            ->references('id')
            ->on('legislative_periods')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->softDeletes();
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
        Schema::dropIfExists('minutes');
    }
}
