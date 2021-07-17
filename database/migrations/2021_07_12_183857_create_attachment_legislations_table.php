<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentLegislationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment_legislations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->unsignedBigInteger('legislation_id');
            $table->unsignedBigInteger('type_document_id');
            $table->string('anexo')->nullable();
            $table->string('nome_original')->nullable();
            $table->timestamps();

            $table->foreign('legislation_id')
            ->references('id')
            ->on('legislations')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('type_document_id')
            ->references('id')
            ->on('type_documents')
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
        Schema::dropIfExists('attachment_legislations');
    }
}
