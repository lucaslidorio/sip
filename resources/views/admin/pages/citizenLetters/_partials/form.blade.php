      <div class="row">
          <div class="col-sm-12">
              <div class="form-group">                  
                  <label for="titulo" class="label-required">Titúlo </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                        </div> 
                    <input type="text" class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" id="titulo"
                        name="titulo" placeholder="Titúlo" value="{{ $citizenLetter->titulo ?? old('titulo') }}">
                    @error('titulo')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                  </div>
              </div>
          </div>       
      </div>
      <div class="row">
        <div class="col-sm-12  ">
            <label for="conteudo" class="label-required">Conteúdo:</label>
            <div class="form-group">
            <textarea class="form-control {{ $errors->has('conteudo') ? 'is-invalid' : '' }}" name="conteudo" id="summernote" cols="30" rows="15" 
                placeholder="Conteúdo da carta">{{$citizenLetter->conteudo ?? old('conteudo')}}</textarea>
                @error('conteudo')
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