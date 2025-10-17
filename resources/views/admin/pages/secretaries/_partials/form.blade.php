<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
            <label for="nome" class="label-required">Nome </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
                </div>
                <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                    name="nome" placeholder="Nome da secretaria" value="{{ $secretary->nome ?? old('nome') }}">
                @error('nome')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="sigla">Sigla</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
                </div>
                <input type="text" class="form-control {{ $errors->has('sigla') ? 'is-invalid' : '' }}" id="sigla"
                    name="sigla" placeholder="Sigla" value="{{ $secretary->sigla ?? old('sigla') }}">
                @error('sigla')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>
    </div>
    <!-- Slogan -->
    <div class="col-sm-5">
        <div class="form-group">
            <label for="slogan">Slogan</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-quote-left"></i></span>
                </div>
                <input type="text" id="slogan" name="slogan" maxlength="45"
                    class="form-control {{ $errors->has('slogan') ? 'is-invalid' : '' }}"
                    placeholder="Slogan da Secretaria" value="{{ old('slogan', $secretary->slogan ?? '') }}">
                @error('slogan')
                <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="nome_responsavel">Nome Secretário(a)/Reponsável:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                </div>
                <input type="text" class="form-control {{ $errors->has('nome_responsavel') ? 'is-invalid' : '' }}"
                    id="nome_responsavel" name="nome_responsavel" placeholder="Nome do Secretário(a) ou responsável"
                    value="{{ $secretary->nome_responsavel ?? old('nome_responsavel') }}">
                @error('nome_responsavel')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="telefone">Telefone da secretaria:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" class="form-control telefone_fixo {{ $errors->has('telefone') ? 'is-invalid' : '' }}"
                    data-inputmask-clearmaskonlostfocus="false" id="telefone" name="telefone"
                    placeholder="Número de tefefone da secretaria"
                    value="{{ $secretary->telefone ?? old('telefone') }}">
                @error('telefone')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="celular">Nº. de celular da secretaria:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text"
                    class="form-control telefone_celular {{ $errors->has('celular') ? 'is-invalid' : '' }} "
                    data-inputmask-clearmaskonlostfocus="false" id="celular" name="celular"
                    placeholder="Número de tefefone da secretaria" value="{{ $secretary->celular ?? old('celular') }}">
                @error('celular')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="endereco">Endereço:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search-location"></i></span>
                </div>
                <input type="text" class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}" id="endereco"
                    name="endereco" placeholder="Rua, Número, Bairro, CEP, Cidade"
                    value="{{ $secretary->endereco ?? old('endereco') }}">
                @error('endereco')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="email">E-mail:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                </div>
                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email"
                    name="email" placeholder="Email da secretaria" value="{{ $secretary->email ?? old('email') }}">
                @error('email')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
                <label for="situacao" class="label-required">Ativo</label>
                <select class="custom-select {{ $errors->has('situacao') ? 'is-invalid' : '' }}" 
                    id="situacao" name="situacao">
                    <option value=""  >Selecione uma opção</option>                    
                    <option value="1" {{isset($secretary) && $secretary->situacao == '1' ? 'selected': ''}} > Sim </option>
                    <option value="0" {{isset($secretary) && $secretary->situacao == '0' ? 'selected': ''}}> Não </option>
                </select>
                @error('situacao')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="icone">Ícone (classe CSS)</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="{{ old('icone', $secretary->icone ?? 'fas fa-icons') }}"></i>
                    </span>
                </div>
                <input type="text" id="icone" name="icone" maxlength="50"
                    class="form-control {{ $errors->has('icone') ? 'is-invalid' : '' }}"
                    placeholder="Ex: fas fa-building" value="{{ old('icone', $secretary->icone ?? '') }}">
                @error('icone')
                <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <small class="text-muted">Use classes do Font Awesome (ex.: fas fa-user-tie)</small>
        </div>
    </div>

    <!-- Cor de Destaque -->
    <div class="col-sm-2">
        <div class="form-group">
            <label for="cor_destaque">Cor de Destaque</label>
            <div class="input-group">
                <input type="color" id="cor_destaque" name="cor_destaque"
                    class="form-control p-1 {{ $errors->has('cor_destaque') ? 'is-invalid' : '' }}"
                    value="{{ old('cor_destaque', $secretary->cor_destaque ?? '#0d6efd') }}">
                @error('cor_destaque')
                <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <small class="text-muted">Formato: #RRGGBB</small>
        </div>
    </div>
    
</div>
<div class="row">
    <!-- Ícone (classe do Font Awesome, por exemplo: fas fa-building) -->
    
</div>

<div class="row">
    <div class="col-sm-8">
        <label for="sobre_secretario">Sobre o Secretário:</label>
        <div class="form-group">
            <textarea class="form-control" name="sobre_secretario" id="sobre_secretario" cols="30" rows="5"
                placeholder="Sobre o Secretário">{{$secretary->sobre_secretario ?? old('sobre_secretario')}}</textarea>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="img_secretario">Foto do Secretário</label>
            <input type="file" class="form-control {{ $errors->has('img_secretario') ? ' is-invalid' : '' }}"
                id="img_secretario" name="img_secretario">
            @error('img_secretario')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
            @enderror
            @if(isset($secretary) && $secretary->img_secretario)
            <div class="mt-2">
                <img src="{{ config('app.aws_url').$secretary->img_secretario }}"
                    alt="{{ $secretary->nome ?? $secretary->img_secretario }}" width="100" height="100">
            </div>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <label for="sobre">Sobre a secretaria:</label>
        <div class="form-group">
            <textarea class="form-control" name="sobre" id="summernote" cols="30" rows="10"
                placeholder="Sobre a secretaria">{{$secretary->sobre ?? old('sobre')}}</textarea>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-sm-12 text-center">
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
                title="Salvar registro">Salvar</button>
        </div>
    </div>