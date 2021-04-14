      
      <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label  for="biennium_legislature_id" class="label-required" >Biênio:</label>
                <select class="form-control select2 {{ $errors->has('biennium_legislature_id') ? 'is-invalid' : '' }}" name="biennium_legislature_id" style="width: 100%;" >
                    <option value="" selected >Selecione um biênio</option>   
                    @foreach ($bienniuns as $biennium)                          
                    <option value="{{$biennium->id}}" 
                          {{old('biennium_legislature_id') ? 'selected' : '' }}>
                          {{$biennium->descricao}} - {{$biennium->legislature->descricao}}             
                        </option>
                    @endforeach 
                </select>
                @error('biennium_legislature_id')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
              </div>
        </div>
        <div class="col-sm-6">            
                <div class="form-group">                  
                    <label for="nome" class="label-required">Nome </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                          </div> 
                      <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                          name="nome" placeholder="Nome da mesa" value="{{ $commission->nome ?? old('nome') }}">
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