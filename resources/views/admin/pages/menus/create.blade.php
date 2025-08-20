@extends('adminlte::page')

@section('title', 'Novo Menu')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1><i class="fas fa-plus"></i> Novo Menu</h1>
        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-edit"></i> Dados do Menu</h3>
                </div>
                <form method="POST" action="{{ route('admin.menus.store') }}" id="menu-form">
                    @csrf
                    @include('admin.pages.menus._partials.form')
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-lg ">
                            <i class="fas fa-save"></i> Salvar
                        </button>                       
                        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary btn-lg ">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-question-circle"></i> Ajuda</h3>
                </div>
                <div class="card-body">
                    <h6><i class="fas fa-info-circle text-info"></i> Tipos de Menu:</h6>
                    <ul class="list-unstyled">
                        <li><strong>Simples:</strong> Link direto para uma página</li>
                        <li><strong>Dropdown:</strong> Menu com submenus tradicionais</li>
                        <li><strong>Mega Menu:</strong> Menu expandido com categorias</li>
                        <li><strong>Categoria:</strong> Seção dentro de um mega menu</li>
                    </ul>
                    
                    <h6><i class="fas fa-icons text-primary"></i> Ícones:</h6>
                    <p>Use classes do Font Awesome 5:</p>
                    <div class="bg-light p-2 rounded">
                        <code>fas fa-home</code>  

                        <code>fas fa-users</code>  

                        <code>fas fa-cog</code>  

                        <code>fas fa-file-alt</code>
                    </div>
                    
                    <h6 class="mt-3"><i class="fas fa-link text-success"></i> URLs:</h6>
                    <ul class="list-unstyled">
                        <li><strong>Absoluta:</strong> https://exemplo.com</li>
                        <li><strong>Relativa:</strong> /pagina</li>
                        <li><strong>Rota:</strong> </li>
                        {{-- {{ "{{ route('nome.rota' ) }}" }}  --}}
                    </ul>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-eye"></i> Preview</h3>
                </div>
                <div class="card-body" id="preview-container">
                    <div class="text-muted text-center">
                        <i class="fas fa-eye-slash fa-2x"></i>
                        <p>Preencha os campos para ver o preview</p>
                    </div>
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
    
    // Salvar e criar novo
    $('#save-and-new').click(function() {
        $('#menu-form').append('<input type="hidden" name="save_and_new" value="1">');
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
