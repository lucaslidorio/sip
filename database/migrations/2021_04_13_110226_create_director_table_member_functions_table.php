<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectorTableMemberFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('director_table_member_functions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('director_table_id'); 
            $table->unsignedBigInteger('councilor_id'); 
            $table->unsignedBigInteger('function_id'); 

            $table->foreign('director_table_id')
                    ->references('id')
                    ->on('director_tables')
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
        Schema::dropIfExists('director_table_member_functions');
    }
}
