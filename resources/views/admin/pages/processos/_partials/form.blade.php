<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            <label for="numero" class="label-required">Número </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                </div>
                <input type="number" class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}" id="numero"
                    name="numero" value="{{ $processo->numero ?? old('numero') }}" autofocus>
                @error('numero')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="label-required">Modalidade:</label>
            <select class="form-control {{ $errors->has('modalidade_id') ? 'is-invalid' : '' }}" name="modalidade_id"
                style="width: 100%;">
                <option value="" selected>Selecione uma Modalidade</option>
                @foreach ($modalidades as $modalidade)
                <option value="{{$modalidade->id}}" {{ (isset($processo) && $modalidade->id == $processo->modalidade->id
                    ? 'selected' : (old('modalidade_id') == $modalidade->id ? 'selected' : '')) }}>
                    {{$modalidade->nome }}
                </option>
                @endforeach
            </select>
            @error('modalidade_id')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
            @enderror
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="label-required">Critério de Julgamento:</label>
            <select class="form-control {{ $errors->has('criterio_julgamento_id') ? 'is-invalid' : '' }}"
                name="criterio_julgamento_id" style="width: 100%;">
                <option value="" selected>Selecione uma Critério de julgamento</option>
                @foreach ($criteriosJulgamento as $criterioJulgamento)
                <option value="{{$criterioJulgamento->id}}" {{ (isset($processo) && $criterioJulgamento->id ==
                    $processo->criterio_julgamento->id ? 'selected' : (old('criterio_julgamento_id') ==
                    $criterioJulgamento->id ? 'selected' : '')) }}>
                    {{$criterioJulgamento->nome }}
                </option>
                @endforeach
            </select>
            @error('criterio_julgamento_id')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
            @enderror
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="label-required">Situação:</label>
            <select class="form-control {{ $errors->has('proceeding_situation_id') ? 'is-invalid' : '' }}"
                name="proceeding_situation_id" style="width: 100%;">
                <option value="" selected>Selecione uma Situação</option>
                @foreach ($situacoes as $situacao)
                <option value="{{$situacao->id}}" {{ (isset($processo) && $situacao->id == $processo->situacao->id ?
                    'selected' : (old('proceeding_situation_id') == $situacao->id ? 'selected' : '')) }}>
                    {{$situacao->nome }}
                </option>
                @endforeach
            </select>
            @error('criterio_julgamento_id')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
            @enderror
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="data_publicacao">Data Publicação:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
                <input type="text" class="form-control" id="data_publicacao" name="data_publicacao"
                    value="{{ isset($processo->data_publicacao) ? $processo->data_publicacao->format('d/m/Y H:i:s') : date('d/m/Y H:i:s') }}" 
                    disabled>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="data_validade" class="label-required" >Válido até:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>

                <input type="date" class="form-control {{ $errors->has('data_validade') ? 'is-invalid' : '' }}"
                    id="data_validade" name="data_validade"
                    value="{{ isset($processo->data_validade_formatada) ? $processo->data_validade_formatada : old('data_validade') }}">
                @error('data_validade')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="qtd_lotes" class="">Qtd lotes </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                </div>
                <input type="number" class="form-control {{ $errors->has('qtd_lotes') ? 'is-invalid' : '' }}"
                    id="qtd_lotes" name="qtd_lotes" value="{{ $processo->qtd_lotes ?? old('qtd_lotes') }}">
                @error('qtd_lotes')
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
        <label for="objeto" class="label-required">Objeto:</label>
        <div class="form-group">
            <textarea class="form-control {{ $errors->has('objeto') ? 'is-invalid' : '' }}" name="objeto" id="objeto" cols="30" rows="4" 
                placeholder="Objeto do processo">{{$processo->objeto ?? old('objeto')}}</textarea>
                @error('objeto')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <label for="descricao">Descrição:</label>
        <div class="form-group">
            <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" name="descricao" id="descricao" cols="30" rows="4" 
                placeholder="Objeto do processo">{{$processo->descricao ?? old('descricao')}}</textarea>
                @error('descricao')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
        </div>
    </div>
</div>
<div class="col-sm-12 text-center">
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
            title="Salvar registro">Salvar</button>
    </div>
</div>