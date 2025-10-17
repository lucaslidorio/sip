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
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('slogan', 255)->nullable()->after('nome');
            $table->string('favicon', 255)->nullable()->after('bandeira');
            $table->string('tiktok', 255)->nullable()->after('twitter');
            $table->string('maps', 500)->nullable()->after('cidade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn(['slogan', 'favicon', 'tiktok', 'maps']);
        });
    }
};
