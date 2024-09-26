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
        Schema::table('documento_assinaturas', function (Blueprint $table) {
            $table->boolean('status')->default(true)->after('codigo_verificacao'); // status: 'valida' ou 'invalida'
            $table->ipAddress('ip_address')->nullable()->after('codigo_verificacao'); // IP do usuário
            $table->string('navegador')->nullable()->after('codigo_verificacao');  // Nome do navegador
            $table->macAddress('mac_address')->nullable()->after('codigo_verificacao'); // MAC Address (se disponível)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documento_assinaturas', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('ip_address');
            $table->dropColumn('navegador');
            $table->dropColumn('mac_address');
        });
    }
};
