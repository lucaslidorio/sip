<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuMegaSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Criando estrutura de mega menu...');

        // 1. Menu Principal - Início
        $inicio = Menu::create([
            'nome' => 'Início',
            'url' => '/',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-home',
            'posicao' => 1,
            'ordem' => 1,
            'ativo' => true
        ]);

        // 2. Menu Dropdown Simples - Município
        $municipio = Menu::create([
            'nome' => 'Município',
            'tipo_menu' => 'dropdown',
            'icone' => 'fas fa-city',
            'posicao' => 1,
            'ordem' => 2,
            'ativo' => true
        ]);

        // Subitens do Município
        Menu::create([
            'menu_pai_id' => $municipio->id,
            'nome' => 'História',
            'url' => '/municipio/historia',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-book',
            'posicao' => 1,
            'ordem' => 1,
            'ativo' => true
        ]);

        Menu::create([
            'menu_pai_id' => $municipio->id,
            'nome' => 'Geografia',
            'url' => '/municipio/geografia',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-map',
            'posicao' => 1,
            'ordem' => 2,
            'ativo' => true
        ]);

        Menu::create([
            'menu_pai_id' => $municipio->id,
            'nome' => 'Dados Gerais',
            'url' => '/municipio/dados-gerais',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-info-circle',
            'posicao' => 1,
            'ordem' => 3,
            'ativo' => true
        ]);

        // 3. Menu Simples - Gabinete
        Menu::create([
            'nome' => 'Gabinete',
            'url' => '/gabinete',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-user-tie',
            'posicao' => 1,
            'ordem' => 3,
            'ativo' => true
        ]);

        // 4. Menu Simples - Secretarias
        Menu::create([
            'nome' => 'Secretarias',
            'url' => '/secretarias',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-building',
            'posicao' => 1,
            'ordem' => 4,
            'ativo' => true
        ]);

        // 5. Menu Simples - Notícias
        Menu::create([
            'nome' => 'Notícias',
            'url' => '/noticias',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-newspaper',
            'posicao' => 1,
            'ordem' => 5,
            'ativo' => true
        ]);

        // 6. MEGA MENU - Transparência
        $transparencia = Menu::create([
            'nome' => 'Transparência',
            'tipo_menu' => 'mega_menu',
            'icone' => 'fas fa-balance-scale',
            'descricao' => 'Portal da Transparência Municipal',
            'posicao' => 1,
            'ordem' => 6,
            'ativo' => true,
            'configuracao' => [
                'colunas' => 3,
                'largura_maxima' => '800px',
                'cor_tema' => '#28a745'
            ]
        ]);

        // Categoria 1: Receitas e Despesas
        $catReceitas = Menu::create([
            'menu_pai_id' => $transparencia->id,
            'nome' => 'Receitas e Despesas',
            'tipo_menu' => 'categoria',
            'icone' => 'fas fa-chart-pie',
            'descricao' => 'Informações sobre receitas e despesas públicas',
            'cor_destaque' => '#28a745',
            'posicao' => 1,
            'ordem' => 1,
            'ativo' => true
        ]);

        // Itens da Categoria Receitas e Despesas
        Menu::create([
            'menu_pai_id' => $transparencia->id,
            'categoria_id' => $catReceitas->id,
            'nome' => 'Receitas Municipais',
            'url' => '/transparencia/receitas',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-money-bill-wave',
            'posicao' => 1,
            'ordem' => 1,
            'ativo' => true
        ]);

        Menu::create([
            'menu_pai_id' => $transparencia->id,
            'categoria_id' => $catReceitas->id,
            'nome' => 'Despesas Públicas',
            'url' => '/transparencia/despesas',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-shopping-cart',
            'posicao' => 1,
            'ordem' => 2,
            'ativo' => true
        ]);

        Menu::create([
            'menu_pai_id' => $transparencia->id,
            'categoria_id' => $catReceitas->id,
            'nome' => 'Execução Orçamentária',
            'url' => '/transparencia/execucao-orcamentaria',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-chart-line',
            'posicao' => 1,
            'ordem' => 3,
            'ativo' => true
        ]);

        // Categoria 2: Contratos e Licitações
        $catContratos = Menu::create([
            'menu_pai_id' => $transparencia->id,
            'nome' => 'Contratos e Licitações',
            'tipo_menu' => 'categoria',
            'icone' => 'fas fa-file-contract',
            'descricao' => 'Contratos, licitações e convênios',
            'cor_destaque' => '#17a2b8',
            'posicao' => 1,
            'ordem' => 2,
            'ativo' => true
        ]);

        // Itens da Categoria Contratos
        Menu::create([
            'menu_pai_id' => $transparencia->id,
            'categoria_id' => $catContratos->id,
            'nome' => 'Contratos Vigentes',
            'url' => '/transparencia/contratos',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-file-signature',
            'posicao' => 1,
            'ordem' => 1,
            'ativo' => true
        ]);

        Menu::create([
            'menu_pai_id' => $transparencia->id,
            'categoria_id' => $catContratos->id,
            'nome' => 'Licitações Abertas',
            'url' => '/transparencia/licitacoes',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-gavel',
            'posicao' => 1,
            'ordem' => 2,
            'ativo' => true
        ]);

        Menu::create([
            'menu_pai_id' => $transparencia->id,
            'categoria_id' => $catContratos->id,
            'nome' => 'Convênios',
            'url' => '/transparencia/convenios',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-handshake',
            'posicao' => 1,
            'ordem' => 3,
            'ativo' => true
        ]);

        // Categoria 3: Recursos Humanos
        $catRH = Menu::create([
            'menu_pai_id' => $transparencia->id,
            'nome' => 'Recursos Humanos',
            'tipo_menu' => 'categoria',
            'icone' => 'fas fa-users',
            'descricao' => 'Informações sobre servidores públicos',
            'cor_destaque' => '#ffc107',
            'posicao' => 1,
            'ordem' => 3,
            'ativo' => true
        ]);

        // Itens da Categoria RH
        Menu::create([
            'menu_pai_id' => $transparencia->id,
            'categoria_id' => $catRH->id,
            'nome' => 'Servidores Públicos',
            'url' => '/transparencia/servidores',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-user-tie',
            'posicao' => 1,
            'ordem' => 1,
            'ativo' => true
        ]);

        Menu::create([
            'menu_pai_id' => $transparencia->id,
            'categoria_id' => $catRH->id,
            'nome' => 'Folha de Pagamento',
            'url' => '/transparencia/folha-pagamento',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-money-check',
            'posicao' => 1,
            'ordem' => 2,
            'ativo' => true
        ]);

        Menu::create([
            'menu_pai_id' => $transparencia->id,
            'categoria_id' => $catRH->id,
            'nome' => 'Diárias e Viagens',
            'url' => '/transparencia/diarias-viagens',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-plane',
            'posicao' => 1,
            'ordem' => 3,
            'ativo' => true
        ]);

        // 7. Menu Dropdown - Serviços Online
        $servicos = Menu::create([
            'nome' => 'Serviços Online',
            'tipo_menu' => 'dropdown',
            'icone' => 'fas fa-laptop',
            'posicao' => 1,
            'ordem' => 7,
            'ativo' => true
        ]);

        // Subitens de Serviços
        Menu::create([
            'menu_pai_id' => $servicos->id,
            'nome' => 'Nota Fiscal Eletrônica',
            'url' => '/servicos/nfe',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-file-invoice',
            'posicao' => 1,
            'ordem' => 1,
            'ativo' => true
        ]);

        Menu::create([
            'menu_pai_id' => $servicos->id,
            'nome' => 'IPTU Online',
            'url' => '/servicos/iptu',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-home',
            'posicao' => 1,
            'ordem' => 2,
            'ativo' => true
        ]);

        Menu::create([
            'menu_pai_id' => $servicos->id,
            'nome' => 'Protocolo Online',
            'url' => '/servicos/protocolo',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-file-alt',
            'posicao' => 1,
            'ordem' => 3,
            'ativo' => true
        ]);

        // 8. Menu Simples - Agenda
        Menu::create([
            'nome' => 'Agenda',
            'url' => '/agenda',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-calendar-alt',
            'posicao' => 1,
            'ordem' => 8,
            'ativo' => true
        ]);

        // 9. Menu Simples - Contato
        Menu::create([
            'nome' => 'Contato',
            'url' => '/contato',
            'tipo_menu' => 'simples',
            'icone' => 'fas fa-envelope',
            'posicao' => 1,
            'ordem' => 9,
            'ativo' => true
        ]);

        $this->command->info('✅ Estrutura de mega menu criada com sucesso!');
        $this->command->info('📊 Resumo:');
        $this->command->info('   - 1 Mega Menu (Transparência) com 3 categorias e 9 itens');
        $this->command->info('   - 2 Menus Dropdown (Município, Serviços Online)');
        $this->command->info('   - 6 Menus Simples');
        $this->command->info('   - Total de ' . Menu::count() . ' itens de menu');
        $this->command->info('');
        $this->command->info('🎯 Para testar:');
        $this->command->info('   1. Execute: php artisan migrate');
        $this->command->info('   2. Acesse a área administrativa');
        $this->command->info('   3. Vá em Menus para gerenciar');
    }
}

