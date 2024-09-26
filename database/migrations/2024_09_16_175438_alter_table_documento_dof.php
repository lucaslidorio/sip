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
        Schema::table('documentos_dof', function (Blueprint $table) {
            $table->string('hash_documento')->nullable()->after('created_at');               // Hash do documento gerado na assinatura
            $table->string('codigo_verificacao')->unique()->nullable()->after('created_at'); // Código de verificação único por documento
           
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documentos_dof', function (Blueprint $table) {
            $table->dropColumn('hash_documento');
            $table->dropColumn('codigo_verificacao');
        });
    }
};
