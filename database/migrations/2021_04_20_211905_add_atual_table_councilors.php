<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAtualTableCouncilors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('councilors', function (Blueprint $table) {
            $table->integer('atual')
             ->after('biografia'); // Ordenado após a coluna "password";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('councilors', function (Blueprint $table) {
            $table->dropColumn('atual');
        });
    }
}
