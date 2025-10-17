<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            // Tipo de menu para suportar mega menus
            $table->enum('tipo_menu', ['simples', 'dropdown', 'mega_menu', 'categoria'])
                  ->default('simples')
                  ->after('icone')
                  ->comment('Tipo do menu: simples, dropdown, mega_menu ou categoria');
            
            // Referência para categoria dentro do mega menu
            $table->unsignedBigInteger('categoria_id')
                  ->nullable()
                  ->after('menu_pai_id')
                  ->comment('ID da categoria para itens dentro de mega menu');
            
            // Descrição/tooltip do menu
            $table->text('descricao')
                  ->nullable()
                  ->after('nome')
                  ->comment('Descrição ou tooltip do menu');
            
            // Cor de destaque para categorias
            $table->string('cor_destaque', 7)
                  ->nullable()
                  ->after('descricao')
                  ->comment('Cor hex para destaque (#FFFFFF)');
            
            // Status ativo/inativo
            $table->boolean('ativo')
                  ->default(true)
                  ->after('cor_destaque')
                  ->comment('Menu ativo ou inativo');
            
            // Configurações extras em JSON
            $table->json('configuracao')
                  ->nullable()
                  ->after('ativo')
                  ->comment('Configurações extras do menu em JSON');
            
            // Chave estrangeira para categoria
            $table->foreign('categoria_id')
                  ->references('id')
                  ->on('menus')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
            
            // Índices para performance
            $table->index(['tipo_menu', 'posicao', 'ordem'], 'idx_menu_tipo_posicao_ordem');
            $table->index(['categoria_id', 'ordem'], 'idx_menu_categoria_ordem');
            $table->index(['ativo', 'posicao'], 'idx_menu_ativo_posicao');
            $table->index(['menu_pai_id', 'ordem'], 'idx_menu_pai_ordem');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            // Remover índices
            $table->dropIndex('idx_menu_tipo_posicao_ordem');
            $table->dropIndex('idx_menu_categoria_ordem');
            $table->dropIndex('idx_menu_ativo_posicao');
            $table->dropIndex('idx_menu_pai_ordem');
            
            // Remover chave estrangeira
            $table->dropForeign(['categoria_id']);
            
            // Remover colunas
            $table->dropColumn([
                'tipo_menu',
                'categoria_id',
                'descricao',
                'cor_destaque',
                'ativo',
                'configuracao'
            ]);
        });
    }
};

