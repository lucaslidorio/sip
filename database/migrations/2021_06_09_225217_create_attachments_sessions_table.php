<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('type_document_id');
            $table->string('anexo');
            $table->string('nome_original')->nullable();
            $table->string('descricao')->nullable();
            $table->timestamps();

            $table->foreign('session_id')
            ->references('id')
            ->on('sessions')
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
        Schema::dropIfExists('attachments_sessions');
    }
}
