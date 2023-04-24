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
        Schema::create('attachments_pages', function (Blueprint $table) {
            $table->id();           
            $table->unsignedBigInteger('page_id');
            $table->unsignedBigInteger('type_document_id');
            $table->string('anexo')->nullable();
            $table->string('nome_original')->nullable();
            $table->timestamps();

            $table->foreign('page_id')
            ->references('id')
            ->on('pages')
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
        Schema::dropIfExists('attachments_pages');
    }
};
