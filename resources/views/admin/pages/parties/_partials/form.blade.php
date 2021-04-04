
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
            <label for="nome" class="label-required">Nome: </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
                    </div>                    
                    <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid': '' }}" id="nome" name="nome" placeholder="Nome do partido" value="{{$party->nome ??  old('nome')}}">
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
            <label for="sigla" class="label-required">Sigla</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-ad"></i></span>
                    </div>                
                    <input type="text"class="form-control {{ $errors->has('sigla') ? 'is-invalid': '' }}" 
                    id="sigla" name="sigla" placeholder="Sigla do partido"  
                    value="{{$party->sigla ?? old('sigla')}}">              
                    @error('sigla')
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
                      <label for="img" class="">Logo do partido:</label>
                      @isset($party)
                      <br>
                          <img src="{{url("storage/{$party->img}")}}" alt="{{$party->nome}}" style="max-width: 200px; padding-bottom: 20px">
                      @endisset      
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
                            </div> 
                        <input type="file" class="form-control {{ $errors->has('img') ? 'is-invalid' : '' }}" id="img"
                            name="img" placeholder="Nenhuma imagem selecionada" value="{{ $party->img ?? old('img') }}">
                        @error('img')
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