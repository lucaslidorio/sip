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
        Schema::table('secretaries', function (Blueprint $table) {
            $table->string('img_secretario', 255)->nullable()->after('nome');
            $table->text('sobre_secretario')->nullable()->after('img_secretario');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('secretaries', function (Blueprint $table) {
            $table->dropColumn(['img_secretario', 'sobre_secretario']);
        });
    }
};
