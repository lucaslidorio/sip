     <div class="row">
          <div class="col-sm-12">
              <div class="form-group">                  
                  <label for="titulo" class="label-required">Titúlo:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                        </div> 
                    <input type="text" class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" id="titulo"
                        name="titulo" placeholder="Titúlo da matéria, posts..." value="{{ $post->titulo ?? old('titulo') }}">
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
          <div class="col-sm-3">
              <div class="form-group">
                  <label for="data_publicacao">Data Publicação:</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" 
                    id="data_publicacao" name="data_publicacao"
                    value="{{ isset($post) ? \Carbon\Carbon::parse($post->data_publicacao)->format('d/m/Y') : now()->format('d/m/Y') }}" 
                    disabled>
                  
                </div>
              </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
                <label for="data_expiracao" >Data Expiracão:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  </div>
                  <input type="date" class="form-control {{ $errors->has('data_expiracao') ? 'is-invalid' : '' }}" 
                      id="data_expiracao" name="data_expiracao"
                      value="{{ $post->data_expiracao ?? old('data_expiracao') }}">
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
                <label class="label-required" >Secretaria:</label>
                <select class="form-control {{ $errors->has('secretary_id') ? 'is-invalid' : '' }}" name="secretary_id" style="width: 100%;" >
                    <option value="" selected ></option>              
                    @foreach ($secretaries as $secretary)                          
                    <option value="{{$secretary->id}}" 
                          {{ (isset($post) && $secretary->id == $post->secretary->id ? 'selected' : (old('secretary_id') == $secretary->id ? 'selected' : '')) }}>
                          {{$secretary->sigla}} - {{$secretary->nome }}              
                        </option>
                    @endforeach 
                </select>
                @error('secretary_id')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
              </div>
        </div>
      </div>

      <div class="card {{ $errors->has('categories') ? 'card-danger' : '' }}">
        <h5 class="card-header "><strong>Categorias </strong> <span class="text-danger">*</span></h5>
        <div class="card-body ">
             @foreach ($categories as $category)            
             <div class="icheck-primary icheck-inline  {{ $errors->has('categories') ? 'is-invalid' : '' }}">
                <input type="checkbox" name="categories[]" value="{{$category->id}}" id="{{$category->id}}"                 
                    @isset($post)
                        @foreach ($post->categories as $postCategoria)                     
                            {{$category->id == $postCategoria->id ? 'checked' : ''}}        
                        @endforeach               
                    @endisset />
              <label for="{{$category->id}}"> {{$category->nome}}</label>     
            </div> 
                  
            @endforeach
            @error('categories')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
            @enderror  
        </div>
      </div> 
      <div class="row">
        @isset($post)
        <br>
        <figure class="figure">
            <figcaption class="figure-caption">Imagem de destaque atual.</figcaption>
            <img src="{{config('app.aws_url')."{$post->img_destaque}" }}" alt="{{$post->titulo}}"
             style="max-width: 200px;">
          
        </figure>    
        @endisset
          </div>       
      
      <div class="row">
          <div class="col-sm-8">
            <div class="form-group"> 
                                 
                <label for="img_destaque" class="label-required">Imagem de Destaque:</label>
               
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
                      </div> 
                  <input type="file" class="form-control {{ $errors->has('img_destaque') ? 'is-invalid' : '' }}" id="img_destaque"
                      name="img_destaque" placeholder="Nenhuma imagem selecionada" value="{{ $post->img_destaque ?? old('img_destaque') }}">
                  @error('img_destaque')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
                  
                </div>
                <span class="text-danger">Dimensões recomendada 1024 x 1900, ultilize o site <a href="https://www.iloveimg.com/pt/redimensionar-imagem" target="_blank" >iloveimg</a> para redimensionar</span>
            </div>
            
          </div>
          <div class="col-sm-4">
            <div class="form-group">
                <label for="destaque" class="label-required">Post em Destaque</label>
                <select class="custom-select {{ $errors->has('destaque') ? 'is-invalid' : '' }}" 
                    id="destaque" name="destaque">
                    <option value=""  >Selecione uma opção</option>                    
                    <option value="1" {{isset($post) && $post->destaque == '1' ? 'selected': ''}} > Sim </option>
                    <option value="0" {{isset($post) && $post->destaque == '0' ? 'selected': ''}}> Não </option>
                </select>
                @error('destaque')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </div>
        </div>
      </div>          
    
    <div class="row border-danger">
        <div class="col-sm-12  ">
            <label for="conteudo" class="label-required">Conteúdo:</label>
            <div class="form-group">
            <textarea class="form-control {{ $errors->has('conteudo') ? 'is-invalid' : '' }}" name="conteudo" id="summernote" cols="30" rows="10" 
                placeholder="Conteúdo da postagem">{{$post->conteudo ?? old('conteudo')}}</textarea>
                @error('conteudo')
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
                <label for="img_destaque">Imagens para Galeria </label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
                      </div> 
                  <input type="file" class="form-control {{ $errors->has('img_galeria') ? 'is-invalid' : '' }}" id="img_galeria"
                      name="img_galeria[]" placeholder="Nenhuma imagem selecinada" 
                      value="{{ $post->img_destaque ?? old('img_galeria') }}" multiple>
                  @error('img_galeria')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
                </div>   
            </div>                
        </div>
    </div>    
        @isset($post)
            <div class="col-sm-12 imgDelete" id="galeria">                 ​           
                @foreach ($post->imagens as $imagem)   
                    <figure class="figure opacity ">                      
                            <img class="img-fluid img-thumbnail  " src="{{config('app.aws_url')."{$imagem->img}" }}" alt="{{$post->titulo}}" style="max-width: 200px; " >
                            <figcaption class="figure-caption text-center">
                            <a href="{{route('posts.deleteImage', $imagem->id)}}" data-id="{{$imagem->id}}"
                                class="btn  bg-gradient-danger  delete-confirm botao" data-toggle="tooltip" data-placement="top"  
                                title="Excluir imagem">
                                Remover
                            </a> 
                            </figcaption>  
                    </figure> 
                @endforeach           
             </div> 
        @endisset              
        <div class="col-sm-12 text-center" >
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
                title="Salvar registro">Salvar</button>
            </div>   
        </div>
   
  

      

    
   