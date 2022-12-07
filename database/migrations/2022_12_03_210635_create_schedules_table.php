<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('councilor_id')->nullable();
            $table->foreign('councilor_id')->references('id')->on('councilors');
            $table->string('title', 255);
            $table->testringxt('description',255)->nullable();
            $table->string('color', 7)->nullable();
            $table->string('textColor', 7)->nullable();
            $table->string('backgroundColor', 7)->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();         

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
        Schema::dropIfExists('schedules');
    }
};
