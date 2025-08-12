<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nome">Nome do Menu *</label>
                <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" 
                       value="{{ old('nome', $menu->nome ?? '') }}" required maxlength="255">
                @error('nome')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">Nome que aparecerá no menu</small>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="tipo_menu">Tipo de Menu *</label>
                <select name="tipo_menu" id="tipo_menu" class="form-control @error('tipo_menu') is-invalid @enderror" required>
                    <option value="">Selecione o tipo...</option>
                    <option value="simples" {{ old('tipo_menu', $menu->tipo_menu ?? '') == 'simples' ? 'selected' : '' }}>
                        Simples (Link direto)
                    </option>
                    <option value="dropdown" {{ old('tipo_menu', $menu->tipo_menu ?? '') == 'dropdown' ? 'selected' : '' }}>
                        Dropdown (Com submenus)
                    </option>
                    <option value="mega_menu" {{ old('tipo_menu', $menu->tipo_menu ?? '') == 'mega_menu' ? 'selected' : '' }}>
                        Mega Menu (Com categorias)
                    </option>
                    <option value="categoria" {{ old('tipo_menu', $menu->tipo_menu ?? '') == 'categoria' ? 'selected' : '' }}>
                        Categoria (Seção de mega menu)
                    </option>
                </select>
                @error('tipo_menu')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group" id="url-field">
                <label for="url">URL</label>
                <input type="text" name="url" id="url" class="form-control @error('url') is-invalid @enderror" 
                       value="{{ old('url', $menu->url ?? '') }}" maxlength="500">
                @error('url')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">
                    Exemplos: /pagina, https://exemplo.com, 
                    
                </small>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <label for="icone">Ícone</label>
                <div class="input-group">
                    <input type="text" name="icone" id="icone" class="form-control @error('icone') is-invalid @enderror" 
                           value="{{ old('icone', $menu->icone ?? '') }}" placeholder="fas fa-home" maxlength="100">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary" id="icon-picker">
                            <i class="fas fa-icons"></i>
                        </button>
                    </div>
                </div>
                @error('icone')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">
                    <span id="icon-preview"></span>
                    <a href="https://fontawesome.com/icons" target="_blank">Ver ícones disponíveis</a>
                </small>
            </div>
        </div>
    </div>

    <div class="row" id="hierarchy-fields">
        <div class="col-md-6">
            <div class="form-group">
                <label for="menu_pai_id">Menu Pai</label>
                <select name="menu_pai_id" id="menu_pai_id" class="form-control select2">
                    <option value="">Nenhum (Menu Principal )</option>
                    @foreach($menusPais as $menuPai)
                        <option value="{{ $menuPai->id }}" 
                                data-tipo="{{ $menuPai->tipo_menu }}"
                                {{ old('menu_pai_id', $menu->menu_pai_id ?? '') == $menuPai->id ? 'selected' : '' }}>
                            {{ $menuPai->nome }} ({{ ucfirst(str_replace('_', ' ', $menuPai->tipo_menu)) }})
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Selecione um menu pai para criar submenu</small>
            </div>
        </div>
        
        <div class="col-md-6" id="categoria-field" style="display: none;">
            <div class="form-group">
                <label for="categoria_id">Categoria</label>
                <select name="categoria_id" id="categoria_id" class="form-control select2">
                    <option value="">Selecione uma categoria...</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" 
                                {{ old('categoria_id', $menu->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Para itens dentro de mega menus</small>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror" 
                  rows="3" maxlength="500">{{ old('descricao', $menu->descricao ?? '') }}</textarea>
        @error('descricao')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
        <small class="form-text text-muted">Tooltip ou descrição do menu (opcional)</small>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="posicao">Posição *</label>
                <select name="posicao" id="posicao" class="form-control @error('posicao') is-invalid @enderror" required>
                    <option value="1" {{ old('posicao', $menu->posicao ?? 1) == 1 ? 'selected' : '' }}>
                        Menu Principal
                    </option>
                    <option value="2" {{ old('posicao', $menu->posicao ?? 1) == 2 ? 'selected' : '' }}>
                        Barra Superior
                    </option>
                    <option value="3" {{ old('posicao', $menu->posicao ?? 1) == 3 ? 'selected' : '' }}>
                        Menu de Acesso
                    </option>
                </select>
                @error('posicao')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group">
                <label for="ordem">Ordem</label>
                <input type="number" name="ordem" id="ordem" class="form-control @error('ordem') is-invalid @enderror" 
                       value="{{ old('ordem', $menu->ordem ?? '') }}" min="0" max="999">
                @error('ordem')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">Deixe vazio para definir automaticamente</small>
            </div>
        </div>
        
        <div class="col-md-3" id="cor-field" style="display: none;">
            <div class="form-group">
                <label for="cor_destaque">Cor de Destaque</label>
                <input type="color" name="cor_destaque" id="cor_destaque" class="form-control @error('cor_destaque') is-invalid @enderror" 
                       value="{{ old('cor_destaque', $menu->cor_destaque ?? '#28a745') }}">
                @error('cor_destaque')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">Para categorias de mega menu</small>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" 
                       value="{{ old('slug', $menu->slug ?? '') }}" maxlength="255">
                @error('slug')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">Gerado automaticamente se vazio</small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="target" id="target" class="custom-control-input" 
                           value="1" {{ old('target', $menu->target ?? false) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="target">
                        <i class="fas fa-external-link-alt"></i> Abrir em nova aba
                    </label>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="ativo" id="ativo" class="custom-control-input" 
                           value="1" {{ old('ativo', $menu->ativo ?? true) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="ativo">
                        <i class="fas fa-eye"></i> Menu ativo
                    </label>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="destaque" id="destaque" class="custom-control-input" 
                           value="1" {{ old('destaque', $menu->destaque ?? false) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="destaque">
                        <i class="fas fa-star"></i> Menu em destaque
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css" rel="stylesheet" />
@stop

@section('js' )
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document ).ready(function() {
    // Inicializar Select2
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    // Mostrar/ocultar campos baseado no tipo
    function toggleFields() {
        const tipo = $('#tipo_menu').val();
        const menuPai = $('#menu_pai_id option:selected').data('tipo');
        
        // Campo URL
        if (tipo === 'dropdown' || tipo === 'mega_menu' || tipo === 'categoria') {
            $('#url-field').hide();
            $('#url').prop('required', false);
        } else {
            $('#url-field').show();
            $('#url').prop('required', true);
        }
        
        // Campo cor (apenas para categorias)
        if (tipo === 'categoria') {
            $('#cor-field').show();
        } else {
            $('#cor-field').hide();
        }
        
        // Campo categoria (apenas para itens dentro de mega menu)
        if (menuPai === 'mega_menu' && tipo === 'simples') {
            $('#categoria-field').show();
        } else {
            $('#categoria-field').hide();
            $('#categoria_id').val('');
        }
    }

    // Auto-gerar slug
    $('#nome').on('input', function() {
        if (!$('#slug').val()) {
            const slug = $(this).val()
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            $('#slug').val(slug);
        }
    });

    // Preview do ícone
    $('#icone').on('input', function() {
        const icone = $(this).val();
        if (icone) {
            $('#icon-preview').html(`<i class="${icone}"></i> `);
        } else {
            $('#icon-preview').html('');
        }
    });

    // Picker de ícones simples
    $('#icon-picker').click(function() {
        const icones = [
            'fas fa-home', 'fas fa-user', 'fas fa-users', 'fas fa-cog', 'fas fa-file-alt',
            'fas fa-newspaper', 'fas fa-calendar', 'fas fa-envelope', 'fas fa-phone',
            'fas fa-map-marker-alt', 'fas fa-building', 'fas fa-graduation-cap',
            'fas fa-heart', 'fas fa-star', 'fas fa-search', 'fas fa-shopping-cart',
            'fas fa-camera', 'fas fa-music', 'fas fa-video', 'fas fa-download'
        ];
        
        let html = '<div class="row">';
        icones.forEach(icone => {
            html += `<div class="col-2 text-center mb-2">
                <button type="button" class="btn btn-sm btn-outline-secondary icon-option" data-icon="${icone}">
                    <i class="${icone}"></i>
                </button>
            </div>`;
        });
        html += '</div>';
        
        bootbox.dialog({
            title: 'Selecionar Ícone',
            message: html,
            size: 'large'
        });
    });

    // Selecionar ícone
    $(document).on('click', '.icon-option', function() {
        const icone = $(this).data('icon');
        $('#icone').val(icone).trigger('input');
        bootbox.hideAll();
    });

    // Event listeners
    $('#tipo_menu, #menu_pai_id').change(toggleFields);
    
    // Executar na inicialização
    toggleFields();
    $('#icone').trigger('input');
});
</script>
@stop
