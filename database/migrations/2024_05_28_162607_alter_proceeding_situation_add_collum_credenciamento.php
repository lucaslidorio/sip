<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('type_documents', function (Blueprint $table) {
            $table->after('nome', function($table){
                $table->string('processo_compra', 255)->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('type_documents', function (Blueprint $table) {
            $table->dropColumn('processo_compra');
        });
    }
};
