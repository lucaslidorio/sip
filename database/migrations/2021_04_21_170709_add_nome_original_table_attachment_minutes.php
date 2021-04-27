<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomeOriginalTableAttachmentMinutes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attachment_minutes', function (Blueprint $table) {
            $table->string('nome_original')
            ->after('anexo'); // Ordenado após a coluna "anexo";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attachment_minutes', function (Blueprint $table) {
            $table->dropColumn('nome_original');
        });
    }
}
