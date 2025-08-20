@extends('adminlte::page')

@section('title', 'Visualizar Menu')

@section('content_header')
    <div class="d-flex justify-content-between">
       
        <h1><i class="fas fa-eye"></i> {{ $menu->nome }}</h1>
        <div>     
            @can('editar-menu')      
            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a> 
            @endcan           
            <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-info-circle"></i> Informações do Menu</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Nome:</dt>
                        <dd class="col-sm-9">
                            @if($menu->icone)
                                <i class="{{ $menu->icone }}"></i>
                            @endif
                            {{ $menu->nome }}
                        </dd>
                        
                        <dt class="col-sm-3">Tipo:</dt>
                        <dd class="col-sm-9">
                            <span class="badge badge-{{ $menu->tipo_menu == 'mega_menu' ? 'success' : ($menu->tipo_menu == 'dropdown' ? 'warning' : ($menu->tipo_menu == 'categoria' ? 'info' : 'secondary')) }}">
                                {{ ucfirst(str_replace('_', ' ', $menu->tipo_menu)) }}
                            </span>
                        </dd>
                        
                        @if($menu->url)
                            <dt class="col-sm-3">URL:</dt>
                            <dd class="col-sm-9">
                                <a href="{{ $menu->getUrlCompleta() }}" target="_blank" class="text-primary">
                                    {{ $menu->url }}
                                    <i class="fas fa-external-link-alt fa-xs"></i>
                                </a>
                            </dd>
                        @endif
                        
                        @if($menu->descricao)
                            <dt class="col-sm-3">Descrição:</dt>
                            <dd class="col-sm-9">{{ $menu->descricao }}</dd>
                        @endif
                        
                        <dt class="col-sm-3">Posição:</dt>
                        <dd class="col-sm-9">
                            @switch($menu->posicao)
                                @case(1) Menu Principal @break
                                @case(2) Barra Superior @break
                                @case(3) Menu de Acesso @break
                                @default Posição {{ $menu->posicao }}
                            @endswitch
                        </dd>
                        
                        <dt class="col-sm-3">Ordem:</dt>
                        <dd class="col-sm-9">{{ $menu->ordem }}</dd>
                        
                        <dt class="col-sm-3">Status:</dt>
                        <dd class="col-sm-9">
                            <span class="badge badge-{{ $menu->ativo ? 'success' : 'danger' }}">
                                {{ $menu->ativo ? 'Ativo' : 'Inativo' }}
                            </span>
                        </dd>
                        
                        @if($menu->target)
                            <dt class="col-sm-3">Abrir em:</dt>
                            <dd class="col-sm-9">Nova aba</dd>
                        @endif
                        
                        @if($menu->parent)
                            <dt class="col-sm-3">Menu Pai:</dt>
                            <dd class="col-sm-9">
                                <a href="{{ route('admin.menus.show', $menu->parent) }}" class="text-primary">
                                    @if($menu->parent->icone)
                                        <i class="{{ $menu->parent->icone }}"></i>
                                    @endif
                                    {{ $menu->parent->nome }}
                                </a>
                            </dd>
                        @endif
                        
                        @if($menu->categoria)
                            <dt class="col-sm-3">Categoria:</dt>
                            <dd class="col-sm-9">
                                <a href="{{ route('admin.menus.show', $menu->categoria) }}" class="text-primary">
                                    @if($menu->categoria->icone)
                                        <i class="{{ $menu->categoria->icone }}"></i>
                                    @endif
                                    {{ $menu->categoria->nome }}
                                </a>
                            </dd>
                        @endif
                        
                        @if($menu->cor_destaque)
                            <dt class="col-sm-3">Cor de Destaque:</dt>
                            <dd class="col-sm-9">
                                <span class="badge" style="background-color: {{ $menu->cor_destaque }}">
                                    {{ $menu->cor_destaque }}
                                </span>
                            </dd>
                        @endif
                        
                        <dt class="col-sm-3">Criado em:</dt>
                        <dd class="col-sm-9">{{ $menu->created_at->format('d/m/Y H:i:s') }}</dd>
                        
                        <dt class="col-sm-3">Atualizado em:</dt>
                        <dd class="col-sm-9">{{ $menu->updated_at->format('d/m/Y H:i:s') }}</dd>
                    </dl>
                </div>
            </div>
            
            {{-- Submenus --}}
            @if($menu->children->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-sitemap"></i> Submenus 
                            <span class="badge badge-info">{{ $menu->children->count() }}</span>
                        </h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.menus.create', ['menu_pai_id' => $menu->id]) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Adicionar Submenu
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Nome</th>
                                        <th>Tipo</th>
                                        <th>URL</th>
                                        <th>Ordem</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($menu->children->sortBy('ordem') as $submenu)
                                        <tr>
                                            <td>
                                                @if($submenu->icone)
                                                    <i class="{{ $submenu->icone }}"></i>
                                                @endif
                                                {{ $submenu->nome }}
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $submenu->tipo_menu == 'categoria' ? 'info' : 'secondary' }}">
                                                    {{ ucfirst(str_replace('_', ' ', $submenu->tipo_menu)) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($submenu->url)
                                                    <a href="{{ $submenu->getUrlCompleta() }}" target="_blank" class="text-primary">
                                                        {{ Str::limit($submenu->url, 30) }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $submenu->ordem }}</td>
                                            <td>
                                                <span class="badge badge-{{ $submenu->ativo ? 'success' : 'danger' }}">
                                                    {{ $submenu->ativo ? 'Ativo' : 'Inativo' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.menus.show', $submenu) }}" class="btn btn-xs btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.menus.edit', $submenu) }}" class="btn btn-xs btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            
            {{-- Categorias (para mega menus) --}}
            @if($menu->isMegaMenu() && $menu->categorias->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tags"></i> Categorias 
                            <span class="badge badge-info">{{ $menu->categorias->count() }}</span>
                        </h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.menus.create', ['menu_pai_id' => $menu->id, 'tipo_menu' => 'categoria']) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-plus"></i> Adicionar Categoria
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($menu->categorias->sortBy('ordem') as $categoria)
                                <div class="col-md-6 mb-3">
                                    <div class="card border-left-primary">
                                        <div class="card-header" style="background-color: {{ $categoria->cor_destaque }}20; border-left: 3px solid {{ $categoria->cor_destaque }}">
                                            <h6 class="mb-0">
                                                @if($categoria->icone)
                                                    <i class="{{ $categoria->icone }}"></i>
                                                @endif
                                                {{ $categoria->nome }}
                                                <span class="badge badge-{{ $categoria->ativo ? 'success' : 'danger' }} ml-2">
                                                    {{ $categoria->ativo ? 'Ativo' : 'Inativo' }}
                                                </span>
                                            </h6>
                                        </div>
                                        <div class="card-body p-2">
                                            @if($categoria->itensCategoria->count() > 0)
                                                <small class="text-muted">Itens:</small>
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($categoria->itensCategoria->sortBy('ordem') as $item)
                                                        <li>
                                                            @if($item->icone)
                                                                <i class="{{ $item->icone }}"></i>
                                                            @endif
                                                            {{ $item->nome }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <small class="text-muted">Nenhum item cadastrado</small>
                                            @endif
                                            
                                            <div class="mt-2">
                                                <a href="{{ route('admin.menus.show', $categoria) }}" class="btn btn-xs btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.menus.edit', $categoria) }}" class="btn btn-xs btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.menus.create', ['categoria_id' => $categoria->id]) }}" class="btn btn-xs btn-success">
                                                    <i class="fas fa-plus"></i> Item
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="col-md-4">
            {{-- Preview --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-eye"></i> Preview</h3>
                </div>
                <div class="card-body">
                    @if($menu->isMegaMenu())
                        <div class="mega-menu-preview">
                            <div class="d-flex align-items-center mb-2">
                                @if($menu->icone)
                                    <i class="{{ $menu->icone }} mr-2"></i>
                                @endif
                                <strong>{{ $menu->nome }}</strong>
                                <i class="fas fa-chevron-down ml-auto"></i>
                            </div>
                            <div class="border rounded p-2 bg-light">
                                <div class="row">
                                    @foreach($menu->categorias->sortBy('ordem') as $categoria)
                                        <div class="col-12 mb-2">
                                            <h6 class="mb-1" style="color: {{ $categoria->cor_destaque }}">
                                                @if($categoria->icone)
                                                    <i class="{{ $categoria->icone }}"></i>
                                                @endif
                                                {{ $categoria->nome }}
                                            </h6>
                                            @foreach($categoria->itensCategoria->sortBy('ordem') as $item)
                                                <small class="d-block ml-3">
                                                    @if($item->icone)
                                                        <i class="{{ $item->icone }}"></i>
                                                    @endif
                                                    {{ $item->nome }}
                                                </small>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @elseif($menu->isDropdown())
                        <div class="dropdown-preview">
                            <div class="d-flex align-items-center mb-2">
                                @if($menu->icone)
                                    <i class="{{ $menu->icone }} mr-2"></i>
                                @endif
                                <strong>{{ $menu->nome }}</strong>
                                <i class="fas fa-chevron-down ml-auto"></i>
                            </div>
                            <div class="border rounded p-2 bg-light">
                                @foreach($menu->children->sortBy('ordem') as $child)
                                    <div class="d-block">
                                        @if($child->icone)
                                            <i class="{{ $child->icone }}"></i>
                                        @endif
                                        {{ $child->nome }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="simple-menu-preview">
                            <div class="d-flex align-items-center">
                                @if($menu->icone)
                                    <i class="{{ $menu->icone }} mr-2"></i>
                                @endif
                                <strong>{{ $menu->nome }}</strong>
                                @if($menu->target)
                                    <i class="fas fa-external-link-alt ml-auto"></i>
                                @endif
                            </div>
                            @if($menu->url)
                                <small class="text-primary d-block mt-1">
                                    <i class="fas fa-link"></i> {{ $menu->url }}
                                </small>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            
            {{-- Estatísticas --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-chart-bar"></i> Estatísticas</h3>
                </div>
                <div class="card-body">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-list"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Submenus</span>
                            <span class="info-box-number">{{ $menu->children->count() }}</span>
                        </div>
                    </div>
                    
                    @if($menu->isMegaMenu())
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fas fa-tags"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Categorias</span>
                                <span class="info-box-number">{{ $menu->categorias->count() }}</span>
                            </div>
                        </div>
                        
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fas fa-sitemap"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total de Itens</span>
                                <span class="info-box-number">{{ $menu->categorias->sum(function($cat) { return $cat->itensCategoria->count(); }) }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            {{-- Ações Rápidas --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-bolt"></i> Ações Rápidas</h3>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if($menu->isDropdown() || $menu->isMegaMenu())
                            <a href="{{ route('admin.menus.create', ['menu_pai_id' => $menu->id]) }}" class="btn btn-success btn-block">
                                <i class="fas fa-plus"></i> Adicionar Submenu
                            </a>
                        @endif
                        
                        @if($menu->isMegaMenu())
                            <a href="{{ route('admin.menus.create', ['menu_pai_id' => $menu->id, 'tipo_menu' => 'categoria']) }}" class="btn btn-info btn-block">
                                <i class="fas fa-tags"></i> Adicionar Categoria
                            </a>
                        @endif
                        
                        
                        @if($menu->url)
                            <a href="{{ $menu->getUrlCompleta() }}" target="_blank" class="btn btn-primary btn-block">
                                <i class="fas fa-external-link-alt"></i> Visualizar no Site
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


