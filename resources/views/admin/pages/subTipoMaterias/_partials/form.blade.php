<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label class="label-required" >Tipo de Matéria:</label>
            <select class="form-control {{ $errors->has('tipo_materia_id') ? 'is-invalid' : '' }}" name="tipo_materia_id" style="width: 100%;" >
                <option value="" selected >Selecione uma opção</option>              
                @foreach ($tiposMaterias as $tipoMateria)                          
                <option value="{{$tipoMateria->id}}" 
                      {{ (isset($subTipoMateria) && $tipoMateria->id == $subTipoMateria->tipo->id ? 'selected' : (old('tipo_materia_id') == $tipoMateria->id ? 'selected' : '')) }}>
                      {{$tipoMateria->nome }}              
                    </option>
                @endforeach 
            </select>
            @error('tipo_materia_id')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
        @enderror
          </div>
    </div>
        <div class="col-sm-4">
        <div class="form-group">                  
            <label for="nome" class="label-required">Nome </label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
                  </div> 
              <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                  name="nome" placeholder="Nome do tipo de matéria" value="{{ $subTipoMateria->nome ?? old('nome') }}" autofocus>
              @error('nome')
                  <small class="invalid-feedback">
                      {{ $message }}
                  </small>
              @enderror
            </div>
        </div>
    </div> 
    <div class="col-sm-4">
        <div class="form-group">
            <label for="situacao" class="label-required">Ativo</label>
            <select class="custom-select {{ $errors->has('situacao') ? 'is-invalid' : '' }}" 
                id="situacao" name="situacao">
                <option value="" selected >Selecione uma opção</option>
                <option value="1" {{isset($subTipoMateria) && $subTipoMateria->situacao_raw == '1' ? 'selected': ''}}> Ativo </option>
                <option value="0" {{isset($subTipoMateria) && $subTipoMateria->situacao_raw == '0' ? 'selected': ''}}> Inativo </option>
            </select>
            @error('situacao')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
        </div>
    </div>      
</div>
<div class="col-sm-12 text-center" >
  <div class="form-group">
      <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
      title="Salvar registro">Salvar</button>
  </div>   
</div>