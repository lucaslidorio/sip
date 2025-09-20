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
            $table->string('slogan', 45)->nullable()->after('sigla');
            $table->string('icone', 50)->nullable()->after('img_secretario');
            $table->string('cor_destaque', 7)->nullable()->after('icone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('secretaries', function (Blueprint $table) {
            $table->dropColumn(['slogan', 'icone', 'cor_destaque']);
        });
    }
};
