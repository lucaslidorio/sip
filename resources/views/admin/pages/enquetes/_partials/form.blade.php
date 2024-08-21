<div class="row">
    <div class="col-sm-10">
        <div class="form-group">                  
            <label for="nome" class="label-required">Nome </label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                  </div> 
              <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                  name="nome" placeholder="Nome da Enquete" value="{{ $enquete->nome ?? old('nome') }}" autofocus>
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
            <label for="situacao">Ativo</label>
            <select class="custom-select {{ $errors->has('situacao') ? 'is-invalid' : '' }}" 
                id="situacao" name="situacao">
                <option value="" selected >Selecione uma opção</option>
                <option value="1" {{isset($enquete) && $enquete->situacao == '1' ? 'selected': ''}}> Ativo </option>
                <option value="0" {{isset($enquete) && $enquete->situacao == '0' ? 'selected': ''}}> Inativo </option>
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