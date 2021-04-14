     <input type="hidden" name="commission_id" value="{{$commission->id}}">
     <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
                <label  for="biennium_legislature_id" class="label-required" >Biênio:</label>
                <select class="form-control select2 {{ $errors->has('biennium_legislature_id') ? 'is-invalid' : '' }}" name="biennium_legislature_id" style="width: 100%;" >
                    <option value="" selected >Selecione um membro</option>              
                    @foreach ($councilors as $councilor)                          
                    <option value="{{$councilor->id}}"
                        {{old('biennium_legislature_id') ? 'selected':'' }}>
                          {{$councilor->nome}} - {{$councilor->party->sigla}}         
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
                    <label  for="function_id" class="label-required" >Função:</label>
                    <select class="form-control select2 {{ $errors->has('function_id') ? 'is-invalid' : '' }}" 
                        name="function_id" style="width: 100%;" >
                        <option value="" selected >Selecione uma função</option>              
                        @foreach ($functions as $function)                          
                        <option value="{{$function->id}}"
                            {{old('function_id') ? 'selected':'' }}>
                              {{$function->nome}}         
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
          </div>  
             
      </div>   
      
    <div class="col-sm-12 text-center" >
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
            title="Salvar registro">Salvar</button>
        </div>   
    </div>