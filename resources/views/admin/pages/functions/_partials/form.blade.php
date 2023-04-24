      <div class="row">
          <div class="col-sm-12">
              <div class="form-group">                  
                  <label for="nome" class="label-required">Nome </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                        </div> 
                    <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                        name="nome" placeholder="Nome da função" value="{{ $function->nome ?? old('nome') }}">
                    @error('nome')
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
                <label for="descricao">Descrição:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-audio-description"></i></span>
                  </div> 
                <input type="text" class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" id="descricao"
                    name="descricao" placeholder="Descrição da função" value="{{ $function->descricao ?? old('descricao') }}">
                @error('descricao')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
                </div>
            </div>
        </div>
      </div>
      
    <div class="col-sm-12 text-center" >
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
            title="Salvar registro">Salvar</button>
        </div>   
    </div>