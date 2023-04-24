<div class="row">
    <div class="col-sm-4">
        <div class="form-group">                  
            <label for="nome" class="label-required">Nome </label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                  </div> 
              <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                  name="nome" placeholder="Nome " value="{{ $link->nome ?? old('nome') }}">
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
            <label for="url" class="label-required">Url </label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-link"></i></span>
                  </div>                   
              <input type="text" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" id="url"
                  name="url" placeholder="url " value="{{ $link->url ?? old('url') }}">
              @error('url')
                  <small class="invalid-feedback">
                      {{ $message }}
                  </small>
              @enderror
            </div>
        </div>
    </div>   
    <div class="col-sm-1">
        <div class="form-group">                  
            <label for="ordem">Ordem </label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-link"></i></span>
                  </div>                   
              <input type="text" class="form-control {{ $errors->has('ordem') ? 'is-invalid' : '' }}" id="ordem"
                  name="ordem" placeholder="Ordem " value="{{ $link->ordem ?? old('ordem') }}">
              @error('ordem')
                  <small class="invalid-feedback">
                      {{ $message }}
                  </small>
              @enderror
            </div>
        </div>
    </div>     
  
    
    <div class="col-sm-3">
        <div class="form-group">
            <label for="target" class="label-required">Nova aba</label>
            <select class="custom-select {{ $errors->has('target') ? 'is-invalid' : '' }}" 
                id="target" name="target">
                <option value=""  >Selecione uma opção</option>                    
                <option value="1" {{isset($link) && $link->target == '1' ? 'selected': ''}} > Sim </option>
                <option value="0" {{isset($link) && $link->target == '0' ? 'selected': ''}}> Não </option>
            </select>
            @error('target')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
        </div>
    </div>  
</div>
<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            <label  for="tipo" class="label-required" >tipo:</label>
            <select class="custom-select {{ $errors->has('tipo') ? 'is-invalid' : '' }}" 
                id="tipo" name="tipo">
                <option value=""  >Selecione uma opção</option>                    
                <option value="1" {{isset($link) && $link->tipo == '1' ? 'selected': ''}} > Banner </option>
                <option value="2" {{isset($link) && $link->tipo == '2' ? 'selected': ''}} > Links úteis </option>
                <option value="3" {{isset($link) && $link->tipo == '3' ? 'selected': ''}}> Serviços Online </option>
            </select>
            @error('tipo')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
        @enderror
          </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label  for="posicao" class="label-required" >Posição:</label>
            <select class="custom-select {{ $errors->has('posicao') ? 'is-invalid' : '' }}" 
                id="posicao" name="posicao">
                <option value=""  >Selecione uma opção</option>                    
                <option value="1" {{isset($link) && $link->posicao == '1' ? 'selected': ''}}> Esquerda </option>
                <option value="2" {{isset($link) && $link->posicao == '2' ? 'selected': ''}}> Topo </option>
                <option value="3" {{isset($link) && $link->posicao == '3' ? 'selected': ''}}> Direita </option>
                <option value="4" {{isset($link) && $link->posicao == '4' ? 'selected': ''}}> Rodape </option>
                <option value="5" {{isset($link) && $link->posicao == '5' ? 'selected': ''}}> Centro </option>

            </select>
            @error('posicao')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
        @enderror
          </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">                  
            <label for="icone" class="">Icone:</label>                  
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
                  </div> 
              <input type="file" class="form-control {{ $errors->has('icone') ? 'is-invalid' : '' }}" id="icone"
                  name="icone" placeholder="Nenhuma imagem selecionada" value="{{ $link->icone ?? old('icone') }}">
              @error('icone')
                  <small class="invalid-feedback">
                      {{ $message }}
                  </small>
              @enderror
            </div>
            <span class="text-danger">Arquivos do tipo .svg</span>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group"> 
            @isset($link)                 
            <label for="icone" class="">Icone atual:</label>            
            <br>
                <img src="{{config('app.aws_url')."{$link->icone}" }}"" alt="{{$link->nome}}" style="max-width: 200px; padding-bottom: 20px">
            @endisset
        </div>
      </div>
</div>
            
 
<div class="col-sm-12 text-center" >
  <div class="form-group">
      <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
      title="Salvar registro">Salvar</button>
  </div>   
</div>