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
        Schema::table('proceeding_situation', function (Blueprint $table) {
            $table->boolean('processo_compra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proceeding_situation', function (Blueprint $table) {
            $table->dropColumn('processo_compra')->nullable();
        });
    }
};
