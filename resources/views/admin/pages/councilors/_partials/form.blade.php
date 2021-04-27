      <div class="row">
          <div class="col-sm-8">
              <div class="form-group">                  
                  <label for="nome" class="label-required">Nome</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                        </div> 
                    <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                        name="nome" placeholder="Nome do parlamentar" value="{{ $councilor->nome ?? old('nome') }}">
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
                  <label for="nome_parlamentar">Nome Parlamentar:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                    </div> 
                  <input type="text" class="form-control {{ $errors->has('nome_parlamentar') ? 'is-invalid' : '' }}" id="nome_parlamentar"
                      name="nome_parlamentar" placeholder="Nome parlamentar" value="{{ $councilor->nome_parlamentar ?? old('nome_parlamentar') }}">
                  @error('nome_parlamentar')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
                  </div>
              </div>
          </div>
      </div>

      <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="data_nascimento" >Data Nascimento:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  </div>
                  <input type="date" class="form-control {{ $errors->has('data_nascimento') ? 'is-invalid' : '' }}" 
                      id="data_nascimento" name="data_nascimento"
                      value="{{ $councilor->data_nascimento ?? old('data_nascimento') }}">
                    @error('data_nascimento')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
              </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text "><i class="far fa-id-card"></i></i></span>
                  </div> 
                <input type="text" class="form-control cpf {{ $errors->has('cpf') ? 'is-invalid' : '' }}" id="cpf"
                    name="cpf" placeholder="CPF do parlamentar" value="{{ $councilor->cpf ?? old('cpf') }}">
                        @error('cpf')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="estado_civil" class="label-required">Estado Civil:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                  </div> 
                <input type="text" class="form-control {{ $errors->has('estado_civil') ? 'is-invalid' : '' }}" id="estado_civil"
                    name="estado_civil" placeholder="Ex. Casado, Solteiro..." value="{{ $councilor->estado_civil ?? old('estado_civil') }}">
                @error('estado_civil')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
                </div>
            </div>
        </div>
      </div>
      <div class="row">
          <div class="col-sm-4">
              <div class="form-group">
                  <label for="naturalidade">Naturalidade:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-city"></i></span>
                    </div> 
                  <input type="text" class="form-control {{ $errors->has('naturalidade') ? 'is-invalid' : '' }}"
                      id="naturalidade" name="naturalidade" placeholder="Cidade e estado"
                      value="{{ $councilor->naturalidade ?? old('naturalidade') }}">
                  @error('naturalidade')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
                  </div>
              </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
                <label for="ocupacao_profissional">Ocupação Profissional:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                  </div> 
                    <input type="text" class="form-control {{ $errors->has('ocupacao_profissional') ? 'is-invalid' : '' }}"
                    id="ocupacao_profissional" name="ocupacao_profissional" placeholder="Ocupação profissional"
                    value="{{ $councilor->ocupacao_profissional ?? old('ocupacao_profissional') }}">
                    @error('ocupacao_profissional')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                </div>
            </div>

            <div class="col-sm-4">
            <div class="form-group">
                <label for="escolaridade">Escolaridade:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user-graduate"></i></span>
                  </div> 
                <input type="text" class="form-control {{ $errors->has('escolaridade') ? 'is-invalid' : '' }}"
                    id="escolaridade" name="escolaridade" placeholder="Escolaridade do parlamentar"
                    value="{{ $councilor->escolaridade ?? old('escolaridade') }}">
                @error('escolaridade')
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
                <label for="endereco">Endereço do Parlamentar:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                  </div>                    
                  <input type="text" class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}"
                      id="endereco" name="endereco" placeholder="Rua, Número, Bairro, CEP, Cidade"
                      value="{{ $councilor->endereco ?? old('endereco') }}">
                  @error('endereco')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
                  </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="endereco_gabinete">Endereço do Gabinete:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                  </div>                    
                  <input type="text" class="form-control {{ $errors->has('endereco_gabinete') ? 'is-invalid' : '' }}"
                      id="endereco_gabinete" name="endereco_gabinete" placeholder="Rua, Número, Bairro, CEP, Cidade"
                      value="{{ $councilor->endereco_gabinete ?? old('endereco_gabinete') }}">
                  @error('endereco_gabinete')
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
                <label for="telefone">Telefone Pessoal:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  </div>
                  <input type="text" class="form-control telefone_celular {{ $errors->has('telefone') ? 'is-invalid' : '' }}" 
                      data-inputmask-clearmaskonlostfocus="false"
                      id="telefone" name="telefone" placeholder="Número de tefefone da secretaria"
                      value="{{ $councilor->telefone ?? old('telefone') }}">
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
                <label for="telefone_gabinete">Telefone Gabinete:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  </div>
                  <input type="text" class="form-control telefone_fixo {{ $errors->has('telefone_gabinete') ? 'is-invalid' : '' }}" 
                      data-inputmask-clearmaskonlostfocus="false"
                      id="telefone_gabinete" name="telefone_gabinete" placeholder="Número de tefefone do gabinete"
                      value="{{ $councilor->telefone_gabinete ?? old('telefone_gabinete') }}">
                  @error('telefone_gabinete')
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
                        id="email" name="email" placeholder="Email pessoal ou institucional"
                        value="{{ $councilor->email ?? old('email') }}">
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
          <div class="col-sm-6">
              <div class="form-group">
                  <label for="facebook">Facebook:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-facebook-square"></i></span>
                    </div>                    
                    <input type="text" class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}"
                        id="facebook" name="facebook" placeholder="Link do facebook"
                        value="{{ $councilor->facebook ?? old('facebook') }}">
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
                <label for="instagram">Instagram:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-instagram-square"></i></span>
                  </div>                    
                  <input type="text" class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}"
                      id="instagram" name="instagram" placeholder="Link do Instagram"
                      value="{{ $councilor->instagram ?? old('instagram') }}">
                  @error('instagram')
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
              <label for="img" class="">Foto oficial do parlamentar:</label>
                    
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
                    </div> 
                <input type="file" class="form-control {{ $errors->has('img') ? 'is-invalid' : '' }}" id="img"
                    name="img" placeholder="Nenhuma imagem selecionada" value="{{ $councilor->img ?? old('img') }}">
                @error('img')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
              </div>
              @isset($councilor)
              <br>
                  <img src="{{url("storage/{$councilor->img}")}}" alt="{{$councilor->nome}}" style="max-width: 100px; padding-bottom: 20px">
              @endisset
          </div>
          
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label  for="partido" class="label-required" >Partido Político:</label>
                <select class="custom-select select2 {{ $errors->has('party_id') ? 'is-invalid' : '' }}" name="party_id" style="width: 100%;" >
                    <option value="" selected >Selecione um partido</option>              
                    @foreach ($parties as $party)                          
                    <option value="{{$party->id}}" 
                          {{ (isset($councilor) && $party->id == $councilor->party->id ? 'selected' : (old('party_id') == $party->id ? 'selected' : '')) }}>
                          {{$party->sigla}} - {{$party->nome }}              
                        </option>
                    @endforeach 
                </select>
                @error('party_id')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
              </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="atual" class="label-required">Atual</label>
                <select class="custom-select {{ $errors->has('atual') ? 'is-invalid' : '' }}" 
                    id="atual" name="atual">
                    <option value="" selected >Selecione uma opção</option>
                    <option value="1"> Sim </option>
                    <option value="0"> Não </option>
                </select>
                @error('atual')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </div>
        </div>     
    </div>   
    <div class="row">
        <div class="col-sm-12">
            <label for="biografia">Biografia:</label>
            <div class="form-group">
            <textarea class="form-control" name="biografia" id="biografia" cols="30" rows="10" 
                placeholder="Uma breve história da trajetória do parlamentar">{{$councilor->biografia ?? old('biografia')}}</textarea>
            </div>
        </div>
    </div>   
      
    <div class="col-sm-12 text-center" >
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
            title="Salvar registro">Salvar</button>
        </div>   
    </div>