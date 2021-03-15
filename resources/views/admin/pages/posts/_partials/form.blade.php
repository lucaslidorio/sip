      <div class="row">
          <div class="col-sm-12">
              <div class="form-group">                  
                  <label for="titulo">Titúlo <span class="text-danger">*</span> </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                        </div> 
                    <input type="text" class="form-control {{ $errors->has('v') ? 'is-invalid' : '' }}" id="titulo"
                        name="titulo" placeholder="Titúlo da matéria, posts..." value="{{ $post->titulo ?? old('titulo') }}">
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
          <div class="col-sm-3">
              <div class="form-group">
                  <label for="data_publicacao">Data Publicação:</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                    <input type="date" class="form-control {{ $errors->has('data_publicacao') ? 'is-invalid' : '' }}" 
                        id="data_publicacao" name="data_publicacao"
                        value="{{ $post->data_publicacao ?? old('data_publicacao') }}">
                    @error('data_publicacao')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
              </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
                <label for="data_expiracao">Data Expiracão:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  </div>
                  <input type="date" class="form-control {{ $errors->has('data_expiracao') ? 'is-invalid' : '' }}" 
                      id="data_expiracao" name="data_expiracao"
                      value="{{ $post->data_expiracao ?? old('data_publicacao') }}">
                  @error('data_expiracao')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
              </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Secretária</label>
                <select class="form-control select2" name="secretary_id" style="width: 100%;">                 
                  @foreach ($secretaries as $secretary)            
                    <option value="{{$secretary->id}}">{{$secretary->sigla}} - {{$secretary->nome}}</option>
                    @endforeach                
                </select>
              </div>
        </div>
      </div>

      <div class="card card-default">
        <h5 class="card-header">Categorias</h5>
        <div class="card-body">
            @foreach ($categories as $category)
                <div class="icheck-primary icheck-inline">
                    <input type="checkbox" name="categories[]" value="{{$category->id}}" id="{{$category->id}}" />
                    <label for="{{$category->id}}"> {{$category->nome}}</label>
                </div>                   
            @endforeach
        </div>
      </div>
            
      
      <div class="row">
          <div class="col-sm-12">
            <div class="form-group">                  
                <label for="img_destaque">Imagem de Destaque <span class="text-danger">*</span> </label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
                      </div> 
                  <input type="file" class="form-control {{ $errors->has('img_destaque') ? 'is-invalid' : '' }}" id="img_destaque"
                      name="img_destaque" placeholder="Nenhuma imagem selecinada" value="{{ $post->img_destaque ?? old('img_destaque') }}">
                  @error('img_destaque')
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
            <label for="conteudo">Conteúdo:</label>
            <div class="form-group">
            <textarea class="form-control" name="conteudo" id="conteudo" cols="30" rows="10" 
                placeholder="Conteúdo da postagem">{{$post->conteudo ?? old('conteudo')}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
          <div class="form-group">                  
              <label for="img_galeria">Imagens para galeria <span class="text-danger">*</span> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
                    </div> 
                <input type="file" class="form-control {{ $errors->has('img_galeria') ? 'is-invalid' : '' }}" id="img_galeria"
                    name="img_galeria" placeholder="Nenhuma imagem selecinada" value="{{ $post->img_galeria ?? old('img_galeria') }}">
                @error('img_galeria')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
              </div>
          </div>

        </div>
    </div>
    
      
    
      <div class="form-group">
          <button type="submit" class="btn btn-success">Salvar</button>
      </div>
