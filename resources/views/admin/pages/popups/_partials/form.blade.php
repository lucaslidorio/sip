<div class="row">
    <div class="col-sm-12">
        <div class="form-group">                  
            <label for="nome" class="label-required">Nome:</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-heading"></i></span>
                  </div> 
              <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                  name="nome" placeholder="Nome do popup." value="{{ $popup->nome ?? old('nome') }}">
              @error('nome')
                  <small class="invalid-feedback">
                      {{ $message }}
                  </small>
              @enderror
            </div>
        </div>
    </div>      
</div><div class="row">
    <div class="col-sm-12">
        <div class="form-group">                  
            <label for="url" class="">Link de redirecionamento:</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-link"></i></span>
                  </div> 
              <input type="text" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" id="url"
                  name="url" placeholder="Link para onde o usuário será encaminhado ao clicar." value="{{ $popup->url ?? old('url') }}">
              @error('url')
                  <small class="invalid-feedback">
                      {{ $message }}
                  </small>
              @enderror
            </div>
        </div>
    </div>      
</div>

<div class="row">
  @isset($popup)
  <br>
  <figure class="figure">
      <figcaption class="figure-caption">Imagem</figcaption>
      <img src="{{config('app.aws_url')."{$popup->img}" }}" alt="{{$popup->nome}}"
       style="max-width: 200px;">
    
  </figure>    
  @endisset
    </div>       

<div class="row">
    <div class="col-sm-6">
      <div class="form-group"> 
                           
          <label for="img" class="label-required">Imagem do Popup:</label>
         
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
                </div> 
            <input type="file" class="form-control {{ $errors->has('img') ? 'is-invalid' : '' }}" id="img"
                name="img" placeholder="Nenhuma imagem selecionada" value="{{ $popup->img ?? old('img') }}">
            @error('img')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror            
          </div>
          {{-- <span class="text-danger">Dimensões recomendada 1024 x 1900, ultilize o site <a href="https://www.iloveimg.com/pt/redimensionar-imagem" target="_blank" >iloveimg</a> para redimensionar</span> --}}
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
                  value="{{ $popup->data_expiracao ?? old('data_expiracao') }}">
              @error('data_expiracao')
                  <small class="invalid-feedback">
                      {{ $message }}
                  </small>
              @enderror
          </div>
        </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
          <label for="ativo" class="label-required">Ativo</label>
          <select class="custom-select {{ $errors->has('ativo') ? 'is-invalid' : '' }}" 
              id="ativo" name="ativo">
              <option value=""  >Selecione uma opção</option>                    
              <option value="1" {{isset($popup) && $popup->ativo == '1' ? 'selected': ''}} > Sim </option>
              <option value="0" {{isset($popup) && $popup->ativo == '0' ? 'selected': ''}}> Não </option>
          </select>
          @error('ativo')
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






