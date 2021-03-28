      <div class="row">
          <div class="col-sm-9">
              <div class="form-group">                  
                  <label for="nome">Nome <span class="text-danger">*</span> </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
                        </div> 
                    <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                        name="nome" placeholder="Nome da secretaria" value="{{ $secretary->nome ?? old('nome') }}">
                    @error('nome')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                  </div>
              </div>
          </div>
          <div class="col-sm-3">
              <div class="form-group">
                  <label for="sigla">Sigla</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
                    </div> 
                  <input type="text" class="form-control {{ $errors->has('sigla') ? 'is-invalid' : '' }}" id="sigla"
                      name="sigla" placeholder="Sigla" value="{{ $secretary->sigla ?? old('sigla') }}">
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
          <div class="col-sm-6">
              <div class="form-group">
                  <label for="nome_responsavel">Nome Secretário(a)/Reponsável:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                    </div> 
                  <input type="text" class="form-control {{ $errors->has('nome_responsavel') ? 'is-invalid' : '' }}"
                      id="nome_responsavel" name="nome_responsavel" placeholder="Nome do Secretário(a) ou responsável"
                      value="{{ $secretary->nome_responsavel ?? old('nome_responsavel') }}">
                  @error('nome_responsavel')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
                  </div>
              </div>
          </div>
          <div class="col-sm-3">
              <div class="form-group">
                  <label for="telefone">Telefone da secretaria:</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control telefone_fixo {{ $errors->has('telefone') ? 'is-invalid' : '' }}" 
                        data-inputmask-clearmaskonlostfocus="false"
                        id="telefone" name="telefone" placeholder="Número de tefefone da secretaria"
                        value="{{ $secretary->telefone ?? old('telefone') }}">
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
                <label for="celular">Nº. de celular da secretaria:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control telefone_celular {{ $errors->has('celular') ? 'is-invalid' : '' }} "
                        data-inputmask-clearmaskonlostfocus="false"
                        id="celular" name="celular"  placeholder="Número de tefefone da secretaria"
                        value="{{ $secretary->celular ?? old('celular') }}">
                    @error('celular')
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
                        value="{{ $secretary->endereco ?? old('endereco') }}">
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
        <div class="col-sm-8">
            <div class="form-group">
                <label for="email">E-mail:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                        </div>    
                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        id="email" name="email" placeholder="Email da secretaria"
                        value="{{ $secretary->email ?? old('email') }}">
                    @error('email')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="situacao">Ativo</label>
                <select class="custom-select form-control-border" id="situacao" name="situacao">
                    <option value="1" selected>Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>
        </div>                               
    </div>  
    <div class="row">
        <div class="col-sm-12">
            <label for="sobre">Sobre a secretaria:</label>
            <div class="form-group">
            <textarea class="form-control" name="sobre" id="sobre" cols="30" rows="10" 
                placeholder="Sobre a secretaia">{{$secretary->sobre ?? old('sobre')}}</textarea>
            </div>
        </div>
    </div>   
      
    
      <div class="form-group">
          <button type="submit" class="btn btn-success">Salvar</button>
      </div>
