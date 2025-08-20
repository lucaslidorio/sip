@extends('adminlte::page')

@section('title', 'Gerenciar Menus')

{{-- Habilita plugins do AdminLTE --}}
@section('plugins.Toast', true)
@section('plugins.Sortable', true)
@section('plugins.Sweetalert2', true)

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1><i class="fas fa-bars"></i> Gerenciar Menus</h1>
    <div>
        @can('editar-menu')
        <a href="{{ route('admin.menus.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Novo Menu
        </a>
        @endcan
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        {{-- Filtros --}}
        <div class="card collapsed-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-filter"></i> Filtros</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <form method="GET" class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Tipo de Menu</label>
                            <select name="tipo_menu" class="form-control form-control-sm">
                                <option value="">Todos</option>
                                <option value="simples" {{ request('tipo_menu')=='simples' ? 'selected' : '' }}>Simples
                                </option>
                                <option value="dropdown" {{ request('tipo_menu')=='dropdown' ? 'selected' : '' }}>
                                    Dropdown</option>
                                <option value="mega_menu" {{ request('tipo_menu')=='mega_menu' ? 'selected' : '' }}>Mega
                                    Menu</option>
                                <option value="categoria" {{ request('tipo_menu')=='categoria' ? 'selected' : '' }}>
                                    Categoria</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Posição</label>
                            <select name="posicao" class="form-control form-control-sm">
                                <option value="">Todas</option>
                                <option value="1" {{ request('posicao')=='1' ? 'selected' : '' }}>Menu Principal
                                </option>
                                <option value="2" {{ request('posicao')=='2' ? 'selected' : '' }}>Barra Superior
                                </option>
                                <option value="3" {{ request('posicao')=='3' ? 'selected' : '' }}>Menu Acesso</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="ativo" class="form-control form-control-sm">
                                <option value="">Todos</option>
                                <option value="1" {{ request('ativo')=='1' ? 'selected' : '' }}>Ativo</option>
                                <option value="0" {{ request('ativo')=='0' ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Menu Pai</label>
                            <select name="menu_pai_id" class="form-control form-control-sm">
                                <option value="">Todos</option>
                                @foreach($menusPais as $menuPai)
                                <option value="{{ $menuPai->id }}" {{ request('menu_pai_id')==$menuPai->id ? 'selected'
                                    : '' }}>
                                    {{ $menuPai->nome }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Pesquisar</label>
                            <div class="input-group input-group-sm">
                                <input type="text" name="pesquisa" class="form-control"
                                    value="{{ request('pesquisa') }}" placeholder="Nome, URL, descrição...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Lista de Menus --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list"></i> Menus Cadastrados
                    <span class="badge badge-info">{{ $menus->total() }}</span>
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th width="50"><i class="fas fa-sort"></i></th>
                                <th>Menu</th>
                                <th width="100">Tipo</th>
                                <th>URL</th>
                                <th width="80">Posição</th>
                                <th width="80">Ordem</th>
                                <th width="80">Status</th>
                                <th width="150">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-menus">
                            @foreach($menus as $menu)
                            <tr data-id="{{ $menu->id }}" class="menu-row menu-level-{{ $menu->level ?? 0 }}">
                                <td>
                                    <i class="fas fa-grip-vertical drag-handle" title="Arrastar para reordenar"></i>
                                    <span class="ordem-display">{{ $menu->ordem }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($menu->icone)
                                        <i class="{{ $menu->icone }} menu-icon"></i>
                                        @endif
                                        <strong>{{ $menu->nome }}</strong>
                                        @if($menu->descricao)
                                        <i class="fas fa-info-circle text-muted ml-1"
                                            title="{{ $menu->descricao }}"></i>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-tipo-{{ $menu->tipo_menu }}">
                                        {{ ucfirst(str_replace('_', ' ', $menu->tipo_menu)) }}
                                    </span>
                                </td>
                                <td>
                                    @if($menu->url)
                                    <a href="{{ $menu->getUrlCompleta() }}" target="_blank" class="text-primary">
                                        {{ Str::limit($menu->url, 30) }}
                                        <i class="fas fa-external-link-alt fa-xs"></i>
                                    </a>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $menu->posicao }}</td>
                                <td>{{ $menu->ordem }}</td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        @can('editar-menu')
                                        <input type="checkbox" class="custom-control-input status-toggle"
                                            id="status-{{$menu->id}}" data-id="{{ $menu->id }}" {{ $menu->ativo ?
                                        'checked' : '' }}>
                                        @endcan
                                        <label class="custom-control-label" for="status-{{ $menu->id }}"></label>
                                    </div>
                                </td>
                                <td class="text-center text-nowrap">

                                    @can('ver-menu')
                                    <a href="{{ route('admin.menus.show', $menu->id) }}"
                                        class="btn btn-flat  bg-gradient-info   " title="Visualizar">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @endcan
                                    @can('editar-menu')
                                    <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                        class="btn btn-flat  bg-gradient-warning " title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan

                                    @can('excluir-menu')
                                    <form method="POST" action="{{ route('admin.menus.destroy', $menu->id) }}"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-flat bg-gradient-danger delete-btn"
                                            data-nome="{{ $menu->nome }}" title="Excluir">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcan

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if($menus->hasPages())
            <div class="card-footer">
                {{ $menus->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@stop
@section('css')
<style>
    /* Drag & Drop Styles */
    .drag-handle {
        cursor: move;
        color: #6c757d;
        padding: 5px;
        transition: color 0.2s;
    }

    .drag-handle:hover {
        color: #007bff;
    }

    .sortable-ghost {
        opacity: 0.4;
        background: #f8f9fa;
    }

    .sortable-chosen {
        background: #e3f2fd;
    }

    .sortable-drag {
        background: #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Menu Hierarchy */
    .menu-level-0 {
        padding-left: 0;
    }

    .menu-level-1 {
        padding-left: 20px;
    }

    .menu-level-2 {
        padding-left: 40px;
    }

    .menu-level-1:before {
        content: "└─ ";
        color: #6c757d;
    }

    .menu-level-2:before {
        content: "  └─ ";
        color: #6c757d;
    }

    /* Badges */
    .badge-tipo-simples {
        background-color: #6c757d;
    }

    .badge-tipo-dropdown {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-tipo-mega_menu {
        background-color: #28a745;
    }

    .badge-tipo-categoria {
        background-color: #17a2b8;
    }

    /* Menu Icons */
    .menu-icon {
        width: 16px;
        text-align: center;
        margin-right: 5px;
    }

    /* Action Buttons */
    .btn-xs {
        padding: 0.125rem 0.25rem;
        font-size: 0.75rem;
        line-height: 1.5;
        border-radius: 0.15rem;
    }

    /* Loading States */
    .loading {
        opacity: 0.6;
        pointer-events: none;
        position: relative;
    }

    .loading::after {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin: -10px 0 0 -10px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #007bff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
@stop
@section('js')

<script>
    $(document ).ready(function() {
    //Configuração do Toastr
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        timeOut: 3000
    };

    // Inicializar Drag & Drop
    initSortable();
    
    // Event Listeners
    initEventListeners();
    
    // Inicializar tooltips
    $('[title]').tooltip();
});

function initSortable() {
    const sortableElement = document.getElementById('sortable-menus');
    if (!sortableElement) return;

    const sortable = Sortable.create(sortableElement, {
        handle: '.drag-handle',
        animation: 150,
        ghostClass: 'sortable-ghost',
        chosenClass: 'sortable-chosen',
        dragClass: 'sortable-drag',
        
        onStart: function(evt) {
            $(evt.item).addClass('dragging');
        },
        
        onEnd: function(evt) {
            $(evt.item).removeClass('dragging');
            
            // Coletar nova ordem
            const items = [];
            $('#sortable-menus tr[data-id]').each(function(index) {
                const id = $(this).data('id');
                if (id) {
                    items.push({
                        id: id,
                        ordem: index + 1
                    });
                }
            });
            
            // Enviar para servidor
            if (items.length > 0) {
                updateOrder(items);
            }
        }
    });
}

function updateOrder(items) {
    $.ajax({
        url: '{{ route("admin.menus.reorder") }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            items: items
        },
        beforeSend: function() {
            $('#sortable-menus').addClass('loading');
        },
        success: function(response) {
            toastr.success(response.message || 'Ordem atualizada com sucesso!');
            
            // Atualizar números de ordem na tabela
            items.forEach(function(item) {
                $(`tr[data-id="${item.id}"] .ordem-display`).text(item.ordem);
            });
        },
        error: function(xhr) {
            toastr.error('Erro ao reordenar menus');
            console.error('Erro:', xhr.responseText);
        },
        complete: function() {
            $('#sortable-menus').removeClass('loading');
        }
    });
}

function initEventListeners() {
    // Toggle Status
    $(document).on('change', '.status-toggle', function() {
        const checkbox = $(this);
        const id = checkbox.data('id');
        const isChecked = checkbox.is(':checked');      
        $.ajax({
            url: `/admin/layout/menus/${id}/toggle`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            beforeSend: function() {
                checkbox.prop('disabled', true);
            },
            success: function(response) {
                toastr.success(response.message);
            },
            error: function() {
                toastr.error('Erro ao alterar status');
                checkbox.prop('checked', !isChecked);
            },
            complete: function() {
                checkbox.prop('disabled', false);
            }
        });
    });


   

    // Excluir Menu
    $(document).on('click', '.delete-btn', function (e) {
    e.preventDefault();

    const form = $(this).closest('form');
    const nome = $(this).data('nome');

    Swal.fire({
        title: 'Deseja continuar?',
        text: `Tem certeza que deseja excluir o menu "${nome}"? Esta ação não pode ser desfeita.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, excluir!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
}
</script>
@include('sweetalert::alert')
@stop