<div class="row">
    <div class="col-sm-4">
        <div class="form-group">                  
            <label for="nome" class="label-required">Nome </label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                  </div> 
              <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                  name="nome" placeholder="Nome " value="{{ $menu->nome ?? old('nome') }}">
              @error('nome')
                  <small class="invalid-feedback">
                      {{ $message }}
                  </small>
              @enderror
            </div>
        </div>
    </div>  
    <div class="col-sm-2">
        <div class="form-group">
            <label for="pagina_interna" class="label-required">Pagina Interna</label>
            <select class="custom-select {{ $errors->has('pagina_interna') ? 'is-invalid' : '' }}" 
                id="pagina_interna" name="pagina_interna">
                <option value=""  >Selecione uma opção</option>                    
                <option value="1" {{isset($menu) && $menu->pagina_interna == '1' ? 'selected': ''}} > Sim </option>
                <option value="0" {{isset($menu) && $menu->pagina_interna == '0' ? 'selected': ''}}> Não </option>
            </select>
            @error('pagina_interna')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
        </div>
    </div> 
    <div class="col-sm-4">
        <div class="form-group">                  
            <label for="url" >Url ou nome da rota </label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-link"></i></span>
                  </div>                   
              <input type="text" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" id="url"
                  name="url" placeholder="url " value="{{ $menu->url ?? old('url') }}">
              @error('url')
                  <small class="invalid-feedback">
                      {{ $message }}
                  </small>
              @enderror
            </div>
        </div>
    </div>       
  
    
    <div class="col-sm-2">
        <div class="form-group">
            <label for="target" class="label-required">Nova aba</label>
            <select class="custom-select {{ $errors->has('target') ? 'is-invalid' : '' }}" 
                id="target" name="target">
                <option value=""  >Selecione uma opção</option>                    
                <option value="1" {{isset($menu) && $menu->target == '1' ? 'selected': ''}} > Sim </option>
                <option value="0" {{isset($menu) && $menu->target == '0' ? 'selected': ''}}> Não </option>
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
    <div class="col-sm-4">
        <div class="form-group">
            <label  for="menu_pai_id" class="label-required" >Submenu de:</label>
            <select class="form-control select2 {{ $errors->has('menu_pai_id') ? 'is-invalid' : '' }}" 
                name="menu_pai_id" id="menu_pai_id" style="width: 100%;" >
                <option value="" selected >Selecione </option>   
                @foreach ($menus as $item)                          
                <option value="{{$item->id}}"
                    {{ (isset($menu) && $item->id == $menu->menu_pai_id ? 'selected' : (old('menu_pai_id') == $item->id ? 'selected' : '')) }} 
                      >
                      {{$item->nome}}             
                    </option>
                @endforeach
            </select>
            @error('menu_pai_id')
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
                <option value="1" {{isset($menu) && $menu->posicao == '1' ? 'selected': ''}}> 1 = Menu Principal </option>
                <option value="2" {{isset($menu) && $menu->posicao == '2' ? 'selected': ''}}> 2 = Barra Superior </option>
                <option value="3" {{isset($menu) && $menu->posicao == '3' ? 'selected': ''}}> 3 = Menu (Acesso) </option>
            </select>
            @error('posicao')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
        @enderror
          </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">                  
            <label for="ordem" >Ordenação</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-sort-numeric-down-alt"></i></span>
                  </div>                   
              <input type="text" class="form-control {{ $errors->has('ordem') ? 'is-invalid' : '' }}" id="ordem"
                  name="ordem" placeholder="ordem " value="{{ $menu->ordem ?? old('ordem') }}">
              @error('ordem')
                  <small class="invalid-feedback">
                      {{ $message }}
                  </small>
              @enderror              
            </div>
            
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">                  
            <label for="icone" >Icone</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-icons"></i></span>
                  </div>                   
              <input type="text" class="form-control {{ $errors->has('icone') ? 'is-invalid' : '' }}" id="icone"
                  name="icone" placeholder="icone " value="{{ $menu->icone ?? old('icone') }}">
              @error('icone')
                  <small class="invalid-feedback">
                      {{ $message }}
                  </small>
              @enderror              
            </div>
            <span class="text-danger">icone fontawesome.com/v5 </span>
        </div>
    </div>

</div>
            
 
<div class="col-sm-12 text-center" >
  <div class="form-group">
      <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
      title="Salvar registro">Salvar</button>
  </div>   
</div>