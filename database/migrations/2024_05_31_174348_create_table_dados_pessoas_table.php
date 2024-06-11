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
        Schema::create('dados_pessoas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');          
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('tipo_pessoa',['F', 'J'])->comment('F = FISICA, J = JURIDICA');
            $table->enum('natureza_juridica',['EI','LTDA','S/A','OUTRAS'])->comment('EI = EIRELE, LTDA = LIMITADA, SA = SOCIEDADE ANÔNIMA');
            $table->enum('enquadramento',[  'MIC', 'EPP', 'GP', 'DE', 'COOP'])
                    ->comment('MIC = MICRO EMPRESA, EPP = EMPRESA DE PEQUENO PORTE, GP = GRANDE PORTE,
            DE = DEMAIS EMPRESAS, COOP = COOPERATIVAS');
            $table->string('nome_fantasia', 255)->nullable();
            $table->string('razao_social', 255)->nullable();        
            $table->char('cnpj', 18)->nullable();
            $table->char('inscricao_estadual', 18)->nullable();
            $table->date('data_abertura')->nullable();
            $table->string('site', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->char('cep', 18)->nullable();
            $table->string('endereco', 100)->nullable();
            $table->char('numero', 6)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('cidade', 100)->nullable();
            $table->char('estado', 18)->nullable();
            $table->char('telefone', 14)->nullable();
            $table->char('celular', 16)->nullable();     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dados_pessoas');
    }
};
