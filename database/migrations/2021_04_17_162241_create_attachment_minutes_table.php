<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentMinutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment_minutes', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger('minute_id');
            $table->string('anexo');
            $table->timestamps();

            $table->foreign('minute_id')
            ->references('id')
            ->on('minutes')
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
        Schema::dropIfExists('attachment_minutes');
    }
}
