<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_member_functions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commission_id');  
            $table->unsignedBigInteger('councilor_id');
            $table->unsignedBigInteger('function_id');

            $table->foreign('commission_id')
                    ->references('id')
                    ->on('commissions')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('councilor_id')
                    ->references('id')
                    ->on('councilors')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('function_id')
                    ->references('id')
                    ->on('functions')
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
        Schema::dropIfExists('commission_members');
    }
}
