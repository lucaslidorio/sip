      <div class="row">
          <div class="col-sm-8">
              <div class="form-group">                  
                  <label for="nome" class="label-required">Nome </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                        </div> 
                    <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                        name="nome" placeholder="Nome da comissão" value="{{ $commission->nome ?? old('nome') }}">
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
                <label for="tipo " class="label-required">Tipo</label>
                <select class="custom-select form-control-border {{ $errors->has('tipo') ? 'is-invalid' : '' }}" 
                    id="tipo" name="tipo">
                    <option selected>Selecione uma opção</option>
                    <option value="1" >Permanente</option>
                    <option value="2">Temporária</option>
                </select>
                @error('tipo')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </div>
        </div>     
      </div>
      <div class="row">
        <div class="col-sm-12">
            <label for="objetivo">Objetivo:</label>
            <div class="form-group">
            <textarea class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }} " name="objetivo" id="objetivo" cols="30" rows="2" 
                placeholder="Sobre a comissão">{{$commission->objetivo ?? old('objetivo')}}</textarea>
                @error('objetivo')
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