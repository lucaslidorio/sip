@extends('adminlte::page')

@section('title', 'Editar Menu')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1><i class="fas fa-edit"></i> Editar Menu: {{ $menu->nome }}</h1>
        <div>
            <a href="{{ route('admin.menus.show', $menu) }}" class="btn btn-info">
                <i class="fas fa-eye"></i> Visualizar
            </a>
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
                    <h3 class="card-title"><i class="fas fa-edit"></i> Dados do Menu</h3>
                </div>
                <form method="POST" action="{{ route('admin.menus.update', $menu->id) }}" id="menu-form">
                    @csrf
                    @method('PUT')
                    @include('admin.pages.menus._partials.form')
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Atualizar
                        </button>                        
                        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-info-circle"></i> Informações</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-5">ID:</dt>
                        <dd class="col-sm-7">{{ $menu->id }}</dd>
                        
                        <dt class="col-sm-5">Criado em:</dt>
                        <dd class="col-sm-7">{{ $menu->created_at->format('d/m/Y H:i') }}</dd>
                        
                        <dt class="col-sm-5">Atualizado em:</dt>
                        <dd class="col-sm-7">{{ $menu->updated_at->format('d/m/Y H:i') }}</dd>
                        
                        @if($menu->children->count() > 0)
                            <dt class="col-sm-5">Submenus:</dt>
                            <dd class="col-sm-7">{{ $menu->children->count() }}</dd>
                        @endif
                    </dl>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-eye"></i> Preview</h3>
                </div>
                <div class="card-body" id="preview-container">
                    <!-- Preview será carregado via JavaScript -->
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
$(document).ready(function() {
    // Preview em tempo real
    $('#menu-form input, #menu-form select, #menu-form textarea').on('input change', function() {
        updatePreview();
    });
    
    // Salvar e continuar editando
    $('#save-and-continue').click(function() {
        $('#menu-form').append('<input type="hidden" name="save_and_continue" value="1">');
        $('#menu-form').submit();
    });
    
    // Atualizar preview inicial
    updatePreview();
});

function updatePreview() {
    const nome = $('#nome').val() || 'Nome do Menu';
    const icone = $('#icone').val() || 'fas fa-circle';
    const tipo = $('#tipo_menu').val() || 'simples';
    const url = $('#url').val() || '#';
    const descricao = $('#descricao').val();
    
    let preview = `
        <div class="preview-menu">
            <div class="d-flex align-items-center">
                <i class="${icone} mr-2"></i>
                <strong>${nome}</strong>
                <span class="badge badge-${tipo === 'mega_menu' ? 'success' : (tipo === 'dropdown' ? 'warning' : 'secondary')} ml-2">
                    ${tipo.replace('_', ' ').toUpperCase()}
                </span>
            </div>
            ${descricao ? `<small class="text-muted d-block mt-1">${descricao}</small>` : ''}
            ${url && tipo === 'simples' ? `<small class="text-primary d-block"><i class="fas fa-link"></i> ${url}</small>` : ''}
        </div>
    `;
    
    $('#preview-container').html(preview);
}
</script>
@stop
