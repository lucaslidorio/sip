<div class="row">
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="user_id">Usuário:</label>
            <select class="form-control select2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}" name="user_id"
                id="user_id" @isset($userFunction) disabled @endisset>
                @foreach ($users as $user)
                <option value="{{$user->id}}" @isset($userFunctions) {{$user->id == $userFunctions->user_id ? 'selected'
                    : ''}}
                    @endisset>
                    {{$user->name}}
                </option>
                @endforeach
            </select>
            @error('user_id')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
            @enderror
        </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="function_id">Função:</label>
            <select class="form-control select2 {{ $errors->has('function_id') ? 'is-invalid' : '' }}"
                name="function_id" id="function_id">
                @foreach ($functions as $function)
                <option value="{{$function->id}}" @isset($userFunctions) {{$function->id == $userFunctions->function_id
                    ? 'selected' : ''}}
                    @endisset>
                    {{$function->nome}} - {{$function->descricao}}
                </option>
                @endforeach
            </select>
            @error('function_id')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
            @enderror
        </div>
    </div>
    <div class="col-xl-6 col-lg-4 com-md-12">
        <div class="form-group">
            <label for="legislacao">Legislação: </label>
            <span class="text-danger">Decreto, portária ... </span>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-audio-description"></i></span>
                </div>
                <input type="text" class="form-control {{ $errors->has('legislacao') ? 'is-invalid' : '' }}"
                    id="legislacao" name="legislacao" placeholder="Descrição da função"
                    value="{{ $function->legislacao ?? old('legislacao') }}">
                @error('legislacao')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label for="data_inicio">Data Início:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
                <input type="date" class="form-control {{ $errors->has('data_inicio') ? 'is-invalid' : '' }}"
                    id="data_inicio" name="data_inicio" value="{{ $userFunction->data_inicio ?? old('data_inicio') }}">
                @error('data_inicio')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label for="data_fim">Data Fim:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
                <input type="date" class="form-control {{ $errors->has('data_fim') ? 'is-invalid' : '' }}" id="data_fim"
                    name="data_fim" value="{{ $userFunction->data_fim ?? old('data_fim') }}">
                @error('data_fim')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label for="situacao" class="label-required">Situação</label>
            <select class="custom-select {{ $errors->has('situacao') ? 'is-invalid' : '' }}" id="situacao"
                name="situacao">
                <option value="1" {{isset($userFunction) && $userFunction->situacao == '1' ? 'selected': ''}}> Ativo
                </option>
                <option value="0" {{isset($userFunction) && $userFunction->situacao == '0' ? 'selected': ''}}> Inativo
                </option>
            </select>
            @error('situacao')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
            @enderror
        </div>
    </div>
</div>


<div class="row">

</div>

<div class="col-sm-12 text-center">
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
            title="Salvar registro">Salvar</button>
    </div>
</div>