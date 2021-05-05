      <div class="row">
          <div class="col-sm-12">
              <div class="form-group">                  
                  <label for="nome" class="label-required">Nome </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
                        </div> 
                    <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                        name="nome" placeholder="Nome da entidade" value="{{ $tenant->nome ?? old('nome') }}">
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
                <label for="endereco">Endereço:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-search-location"></i></span>
                  </div>                    
                  <input type="text" class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}"
                      id="endereco" name="endereco" placeholder="Rua, Número, Bairro, CEP, Cidade"
                      value="{{ $tenant->endereco ?? old('endereco') }}">
                  @error('endereco')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
                  </div>
            </div>
        </div>
    </div>


      <div class="row">
          <div class="col-sm-2">
              <div class="form-group">
                  <label for="numero">Número:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search-location"></i></span>
                    </div> 
                  <input type="text" class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}"
                      id="numero" name="numero" placeholder="Número"
                      value="{{ $tenant->numero ?? old('numero') }}">
                  @error('numero')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
                  </div>
              </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
                <label for="bairro">Bairro:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-search-location"></i></span>
                  </div> 
                <input type="text" class="form-control {{ $errors->has('bairro') ? 'is-invalid' : '' }}"
                    id="bairro" name="bairro" placeholder="Bairro"
                    value="{{ $tenant->bairro ?? old('bairro') }}">
                @error('bairro')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-city"></i></span>
                  </div> 
                <input type="text" class="form-control {{ $errors->has('cidade') ? 'is-invalid' : '' }}"
                    id="cidade" name="cidade" placeholder="Cidade"
                    value="{{ $tenant->cidade ?? old('cidade') }}">
                @error('cidade')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
                </div>
            </div>
        </div>
          <div class="col-sm-3">
              <div class="form-group">
                  <label for="telefone">Telefone:</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control telefone_fixo {{ $errors->has('telefone') ? 'is-invalid' : '' }}" 
                        data-inputmask-clearmaskonlostfocus="false"
                        id="telefone" name="telefone" placeholder="Número de tefefone"
                        value="{{ $tenant->telefone ?? old('telefone') }}">
                    @error('telefone')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
              </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
                <label for="celular">Nº. de celular:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control telefone_celular {{ $errors->has('celular') ? 'is-invalid' : '' }} "
                        data-inputmask-clearmaskonlostfocus="false"
                        id="celular" name="celular"  placeholder="Número de telefone celular"
                        value="{{ $tenant->celular ?? old('celular') }}">
                    @error('celular')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
            </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="email">E-mail:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                        </div>    
                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        id="email" name="email" placeholder="Email"
                        value="{{ $tenant->email ?? old('email') }}">
                    @error('email')
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
                <label for="cnpj">CNPJ:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-fingerprint"></i></span>
                    </div>
                    <input type="text" class="form-control cnpj {{ $errors->has('cnpj') ? 'is-invalid' : '' }} "
                        data-inputmask-clearmaskonlostfocus="false"
                        id="cnpj" name="cnpj"  placeholder="Cnpj"
                        value="{{ $tenant->cnpj ?? old('cnpj') }}">
                    @error('cnpj')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
            </div>
            </div>
        </div>      
        <div class="col-sm-9">
            <div class="form-group">
                <label for="dia_atendimento">Dias de Atendimento:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-people-arrows"></i></span>
                  </div>                    
                  <input type="text" class="form-control {{ $errors->has('dia_atendimento') ? 'is-invalid' : '' }}"
                      id="dia_atendimento" name="dia_atendimento" placeholder="Dias de atendimento"
                      value="{{ $tenant->dia_atendimento ?? old('dia_atendimento') }}">
                  @error('dia_atendimento')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
                  </div>
            </div>
        </div>
    </div>        
   
    <div class="row"> 
        
                                  
    </div> 
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="facebook">Facebook:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-facebook-square"></i></span>
                  </div>                    
                  <input type="text" class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}"
                      id="facebook" name="facebook" placeholder="Link do facebook"
                      value="{{ $tenant->facebook ?? old('facebook') }}">
                  @error('facebook')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
                  </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="youtube">YouTube:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                  </div>                    
                  <input type="text" class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}"
                      id="youtube" name="youtube" placeholder="Link do YouTube"
                      value="{{ $tenant->youtube ?? old('youtube') }}">
                  @error('youtube')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
                  </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="instagram">Instagram:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-instagram-square"></i></span>
                  </div>                    
                  <input type="text" class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}"
                      id="instagram" name="instagram" placeholder="Link do Instagram"
                      value="{{ $tenant->instagram ?? old('instagram') }}">
                  @error('instagram')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
                  </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="twitter">Twitter:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                  </div>                    
                  <input type="text" class="form-control {{ $errors->has('twitter') ? 'is-invalid' : '' }}"
                      id="twitter" name="twitter" placeholder="Link do Twiter"
                      value="{{ $tenant->twiter ?? old('twitter') }}">
                  @error('twitter')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
                  </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">                  
                <label for="brasao" class="">Brasao: </label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
                      </div> 
                  <input type="file" class="form-control {{ $errors->has('brasao') ? 'is-invalid' : '' }}" id="brasao"
                      name="brasao" placeholder="Nenhum arquivo selecionado" 
                      value="">                      
                  @error('brasao')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror                 
                </div>   
                
            </div>                
        </div>
        <div class="col-sm-6">
            <div class="form-group">                  
                <label for="bandeira" class="">Bandeira: </label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
                      </div> 
                  <input type="file" class="form-control {{ $errors->has('bandeira') ? 'is-invalid' : '' }}" id="bandeira"
                      name="bandeira" placeholder="Nenhum arquivo selecionado" 
                      value="">                      
                  @error('bandeira')
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