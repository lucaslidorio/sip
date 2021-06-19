     <input type="hidden" name="legislature_id" value="{{$legislature->id}}">
     <div class="row">
          <div class="col-sm-7">
            <div class="form-group">
                <label  for="councilor_id" class="label-required" >Vereador:</label>
                <select class="form-control select2 {{ $errors->has('councilor_id') ? 'is-invalid' : '' }}" name="councilor_id" style="width: 100%;" >
                    <option value="" selected >Selecione um vereador</option>              
                    @foreach ($councilors as $councilor)                          
                    <option value="{{$councilor->id}}"
                        {{old('councilor_id') ? 'selected':'' }}>
                          {{$councilor->nome}} - {{$councilor->party->sigla}}         
                        </option>
                    @endforeach 
                </select>
                    @error('councilor_id')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                    @enderror
              </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">                  
                    <label for="qtd_votos" class="">Qtd Votos:</label>
                      <div class="input-group">                        
                      <input type="number" class="form-control {{ $errors->has('c') ? 'is-invalid' : '' }}" 
                      id="qtd_votos" name="qtd_votos" placeholder="" value="{{ $post->titulo ?? old('qtd_votos') }}">
                      @error('qtd_votos')
                          <small class="invalid-feedback">
                              {{ $message }}
                          </small>
                      @enderror
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="situacao" class="label-required">Situação</label>
                    <select class="custom-select {{ $errors->has('situacao') ? 'is-invalid' : '' }}" 
                        id="situacao" name="situacao">
                        <option value="" selected >Selecione uma opção</option>
                        <option value="1" {{isset($councilor) && $councilor->atual == '1' ? 'selected': ''}}> Ativo </option>
                        <option value="0" {{isset($councilor) && $councilor->atual == '0' ? 'selected': ''}}> Inativo </option>
                    </select>
                    @error('situacao')
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