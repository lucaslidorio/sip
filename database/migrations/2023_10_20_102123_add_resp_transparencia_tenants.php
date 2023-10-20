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
            $table->string('nome_resp_transparencia');
            $table->char('telefone_resp_transparencia',14)->nullable();
            $table->string('email_resp_transparencia')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn('nome_resp_transparencia');
            $table->dropColumn('telefone_resp_transparencia');
            $table->dropColumn('email_resp_transparencia');
        });
    }
};
