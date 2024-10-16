      <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
                <label  for="user_id" >Usuário:</label>
                <select class="form-control select2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}" 
                    name="user_id" id="user_id" style="width: 100%;"  >
                    {{-- <option value="" selected >Selecione um autor</option>    --}}
                    @foreach ($users as $user)                          
                    <option value="{{$user->id}}"
                        @isset($userFunctions)                                                                
                                {{$user->id == $userFunctions->user_id ? 'selected' : ''}}        
                                     
                    @endisset
                        >
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
                    name="descricao" placeholder="Descrição da função" value="{{ $function->descricao ?? old('descricao') }}" >
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