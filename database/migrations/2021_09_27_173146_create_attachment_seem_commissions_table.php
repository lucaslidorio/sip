<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentSeemCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment_seem_commissions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->unsignedBigInteger('seem_commission_id');
            $table->unsignedBigInteger('type_document_id');
            $table->string('anexo')->nullable();
            $table->string('nome_original')->nullable();
            $table->timestamps();

            $table->foreign('seem_commission_id')
            ->references('id')
            ->on('seem_commissions')
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
        Schema::dropIfExists('attachment_seem_commissions');
    }
}
