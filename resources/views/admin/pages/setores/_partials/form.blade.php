<div class="row">
    <div class="col-sm-6">
        <div class="form-group">                  
            <label for="nome" class="label-required">Nome </label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-thumbtack"></i></span>
                  </div> 
              <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                  name="nome" placeholder="Nome do Setor" value="{{ $setor->nome ?? old('nome') }}" autofocus>
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
            <label class="label-required" >Secretaria:</label>
            <select class="form-control {{ $errors->has('secretary_id') ? 'is-invalid' : '' }}" name="secretary_id" style="width: 100%;" >
                <option value="" selected ></option>              
                @foreach ($secretaries as $secretary)                          
                <option value="{{$secretary->id}}" 
                      {{ (isset($setor) && $secretary->id == $setor->secretary->id ? 'selected' : (old('secretary_id') == $secretary->id ? 'selected' : '')) }}>
                      {{$secretary->sigla}} - {{$secretary->nome }}              
                    </option>
                @endforeach 
            </select>
            @error('secretary_id')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
        @enderror
          </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="situacao">Ativo</label>
            <select class="custom-select {{ $errors->has('situacao') ? 'is-invalid' : '' }}" 
                id="situacao" name="situacao">
                <option value="" selected >Selecione uma opção</option>
                <option value="1" {{isset($setor) && $setor->situacao == '1' ? 'selected': ''}}> Ativo </option>
                <option value="0" {{isset($setor) && $setor->situacao == '0' ? 'selected': ''}}> Inativo </option>
            </select>
        </div>
    </div>
</div>

  

<div class="col-sm-12 text-center" >
  <div class="form-group">
      <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
      title="Salvar registro">Salvar</button>
  </div>   
</div>